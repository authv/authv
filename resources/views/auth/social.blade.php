<ul class="mo-idp-list">
  @if (in_array('google', config('mo.socialite')))
  <li class="mo-list-item">
    <a href="{{ url('/oauth2/google') }}" class="mo-idp-button mdl-button mdl-js-button mdl-button--raised mo-idp-google mo-id-idp-button" data-provider-id="google.com">
      <img class="mo-idp-icon" src="/images/mo/google.svg">
      <span class="mo-idp-text mo-idp-text-long">Sign in with Google</span>
      <span class="mo-idp-text mo-idp-text-short">Google</span>
    </a>
  </li>
  @endif
  @if (in_array('facebook', config('mo.socialite')))
  <li class="mo-list-item">
    <a href="{{ url('/oauth2/facebook') }}" class="mo-idp-button mdl-button mdl-js-button mdl-button--raised mo-idp-facebook mo-id-idp-button" data-provider-id="facebook.com">
      <img class="mo-idp-icon" src="/images/mo/facebook.svg">
      <span class="mo-idp-text mo-idp-text-long">Sign in with Facebook</span>
      <span class="mo-idp-text mo-idp-text-short">Facebook</span>
    </a>
  </li>
  @endif
  @if (in_array('twitter', config('mo.socialite')))
  <li class="mo-list-item">
    <a href="{{ url('/oauth2/twitter') }}" class="mo-idp-button mdl-button mdl-js-button mdl-button--raised mo-idp-twitter mo-id-idp-button" data-provider-id="twitter.com">
      <img class="mo-idp-icon" src="/images/mo/twitter.svg">
      <span class="mo-idp-text mo-idp-text-long">Sign in with Twitter</span>
      <span class="mo-idp-text mo-idp-text-short">Twitter</span>
    </a>
  </li>
  @endif
  @if (in_array('linkedin', config('mo.socialite')))
  <li class="mo-list-item">
    <a href="{{ url('/oauth2/linkedin') }}" class="mo-idp-button mdl-button mdl-js-button mdl-button--raised mo-idp-linkedin mo-id-idp-button" data-provider-id="linkedin.com">
      <img class="mo-idp-icon" src="/images/mo/linkedin.svg">
      <span class="mo-idp-text mo-idp-text-long">Sign in with LinkedIn</span>
      <span class="mo-idp-text mo-idp-text-short">LinkedIn</span>
    </a>
  </li>
  @endif
  @if (in_array('github', config('mo.socialite')))
  <li class="mo-list-item">
    <a href="{{ url('/oauth2/github') }}" class="mo-idp-button mdl-button mdl-js-button mdl-button--raised mo-idp-github mo-id-idp-button" data-provider-id="github.com">
      <img class="mo-idp-icon" src="/images/mo/github.svg">
      <span class="mo-idp-text mo-idp-text-long">Sign in with GitHub</span>
      <span class="mo-idp-text mo-idp-text-short">GitHub</span>
    </a>
  </li>
  @endif
  @if (in_array('bitbucket', config('mo.socialite')))
  <li class="mo-list-item">
    <a href="{{ url('/oauth2/bitbucket') }}" class="mo-idp-button mdl-button mdl-js-button mdl-button--raised mo-idp-bitbucket mo-id-idp-button" data-provider-id="github.com">
      <img class="mo-idp-icon" src="/images/mo/bitbucket.svg">
      <span class="mo-idp-text mo-idp-text-long">Sign in with Bitbucket</span>
      <span class="mo-idp-text mo-idp-text-short">Bitbucket</span>
    </a>
  </li>
  @endif
</ul>
