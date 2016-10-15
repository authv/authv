<?php

namespace App\Http\Controllers\SSO;

use App\Exceptions\SSO\ClientNotFoundException;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Client\SSO;
use Auth;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    private $input;
    private $client;
    private $user;
    private $nonce;

    public $client_key = 'client_id';
    protected $payload_key = 'sso';
    protected $signature_key = 'sig';
    protected $nonce_key = 'nonce';

    protected $payload_response_key = 'sso';
    protected $signature_response_key = 'sig';

    protected function getCallbackUrl()
    {
        return $this->getClient()->redirect;
    }

    protected function getSecret()
    {
        return $this->getClient()->secret;
    }

    protected function getClient()
    {
        if ($this->client) {
            return $this->client;
        }
        $client = SSO::where('id', $this->getClientId())->first();
        if ($client) {
            $this->client = $client;

            return $this->client;
        }
        throw new ClientNotFoundException();
    }

    protected function getClientId()
    {
        return $this->input[$this->client_key];
    }

    protected function getPayload()
    {
        return $this->input[$this->payload_key];
    }

    protected function getDecodedPayload()
    {
        return urldecode($this->getPayload());
    }

    protected function getRequestPayloadSignature()
    {
        return hash_hmac('sha256', $this->getDecodedPayload(), $this->getSecret());
    }

    protected function getSignature()
    {
        return $this->input[$this->signature_key];
    }

    protected function getUser()
    {
        if ($this->user) {
            return $this->user;
        }
        if (Auth::check()) {
            $this->user = Auth::user();

            return $this->user;
        }

        return false;
    }

    protected function putInSession(Request $request)
    {
        $request->session()->put($this->client_key, $request->input($this->client_key));
        $request->session()->put($this->payload_key, $request->input($this->payload_key));
        $request->session()->put($this->signature_key, $request->input($this->signature_key));
    }

    protected function forgotInSession(Request $request)
    {
        $request->session()->forget($this->client_key);
        $request->session()->forget($this->payload_key);
        $request->session()->forget($this->signature_key);
    }

    public function get(Request $request)
    {
        if ($this->getUser()) {
            $this->setInput($request);
            if ($this->isValid()) {
                $this->forgotInSession($request);

                return redirect($this->getCallbackUrl().'?'.$this->getResponseQuery());
            }

            return response('Bad SSO request', 403)->header('Content-Type', 'text/plain');
        } else {
            $this->putInSession($request);

            return redirect()->route('login');
        }
    }

    protected function setInput(Request $request)
    {
        if ($request->has($this->client_key) && $request->has($this->payload_key) && $request->has($this->signature_key)) {
            $this->setInputFromRequest($request);
        } elseif ($request->session()->has($this->client_key) && $request->session()->has($this->payload_key) && $request->session()->has($this->signature_key)) {
            $this->setInputFromSession($request);
        }
    }

    protected function setInputFromRequest(Request $request)
    {
        $this->input = $request->only([$this->client_key, $this->payload_key, $this->signature_key]);
    }

    protected function setInputFromSession($request)
    {
        $client_id = $request->session()->get($this->client_key);
        $payload = $request->session()->get($this->payload_key);
        $signature = $request->session()->get($this->signature_key);
        $this->input = [$this->client_key => $client_id, $this->payload_key => $payload, $this->signature_key => $signature];
    }

    protected function isValid()
    {
        $valid = ($this->input[$this->payload_key] && $this->input[$this->signature_key] && $this->getClient() && $this->getNonceFromPayload());

        return $valid && ($this->getRequestPayloadSignature() === $this->getSignature());
    }

    protected function getNonceFromPayload()
    {
        if ($this->nonce) {
            return $this->nonce;
        }
        $payloads = [];
        parse_str(base64_decode($this->getDecodedPayload()), $payloads);
        if (!array_key_exists($this->nonce_key, $payloads)) {
            return false;
        }
        $this->nonce = $payloads[$this->nonce_key];

        return $this->nonce;
    }

    public function getResponseParameters()
    {
        $user = $this->getUser();

        return [
      'nonce'       => $this->getNonceFromPayload(),
      'external_id' => $user->id,
      'email'       => $user->email,
      'name'        => $user->name,
      'username'    => $user->username,
    ];
    }

    protected function getResponsePayload()
    {
        return base64_encode(http_build_query($this->getResponseParameters()));
    }

    protected function getResponseQuery()
    {
        $response = [
      $this->payload_response_key   => $this->getResponsePayload(),
      $this->signature_response_key => $this->getResponsePayloadSignature(),
    ];

        return http_build_query($response);
    }

    protected function getResponsePayloadSignature()
    {
        return hash_hmac('sha256', $this->getResponsePayload(), $this->getSecret());
    }
}
