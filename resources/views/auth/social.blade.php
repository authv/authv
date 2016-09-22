<ul class="idp-list">
  @if (in_array('google', config('authv.socialite')))
  <li class="idp-list-item">
    <a href="{{ url('/oauth2/google') }}" class="idp-button mdl-button mdl-js-button mdl-button--raised idp-google id-idp-button" data-provider-id="google.com">
      <img class="idp-icon" src="/images/authv/google.svg">
      <span class="idp-text idp-text-long">Sign in with Google</span>
      <span class="idp-text idp-text-short">Google</span>
    </a>
  </li>
  @endif
  @if (in_array('facebook', config('authv.socialite')))
  <li class="idp-list-item">
    <a href="{{ url('/oauth2/facebook') }}" class="idp-button mdl-button mdl-js-button mdl-button--raised idp-facebook id-idp-button" data-provider-id="facebook.com">
      <img class="idp-icon" src="/images/authv/facebook.svg">
      <span class="idp-text idp-text-long">Sign in with Facebook</span>
      <span class="idp-text idp-text-short">Facebook</span>
    </a>
  </li>
  @endif
  @if (in_array('twitter', config('authv.socialite')))
  <li class="idp-list-item">
    <a href="{{ url('/oauth2/twitter') }}" class="idp-button mdl-button mdl-js-button mdl-button--raised idp-twitter id-idp-button" data-provider-id="twitter.com">
      <img class="idp-icon" src="/images/authv/twitter.svg">
      <span class="idp-text idp-text-long">Sign in with Twitter</span>
      <span class="idp-text idp-text-short">Twitter</span>
    </a>
  </li>
  @endif
  @if (in_array('linkedin', config('authv.socialite')))
  <li class="idp-list-item">
    <a href="{{ url('/oauth2/linkedin') }}" class="idp-button mdl-button mdl-js-button mdl-button--raised idp-linkedin id-idp-button" data-provider-id="linkedin.com">
      <img class="idp-icon" src="/images/authv/linkedin.svg">
      <span class="idp-text idp-text-long">Sign in with LinkedIn</span>
      <span class="idp-text idp-text-short">LinkedIn</span>
    </a>
  </li>
  @endif
  @if (in_array('github', config('authv.socialite')))
  <li class="idp-list-item">
    <a href="{{ url('/oauth2/github') }}" class="idp-button mdl-button mdl-js-button mdl-button--raised idp-github id-idp-button" data-provider-id="github.com">
      <img class="idp-icon" src="/images/authv/github.svg">
      <span class="idp-text idp-text-long">Sign in with GitHub</span>
      <span class="idp-text idp-text-short">GitHub</span>
    </a>
  </li>
  @endif
  @if (in_array('bitbucket', config('authv.socialite')))
  <li class="idp-list-item">
    <a href="{{ url('/oauth2/bitbucket') }}" class="idp-button mdl-button mdl-js-button mdl-button--raised idp-bitbucket id-idp-button" data-provider-id="github.com">
      <img class="idp-icon" src="/images/authv/bitbucket.svg">
      <span class="idp-text idp-text-long">Sign in with Bitbucket</span>
      <span class="idp-text idp-text-short">Bitbucket</span>
    </a>
  </li>
  @endif
</ul>
