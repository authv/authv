@extends('layouts.minimal')

@section('content')
<h4 class="h-m-top--sm">Sign in to continue</h4>
<div class="mdl-grid">
  <div class="mdl-layout-spacer"></div>
  <div class="is-small-screen">
    @include('auth.social')
  </div>
  <div class="mdl-layout-spacer"></div>
</div>
<div class="mdl-grid">
  <div class="mdl-layout-spacer"></div>
  <form class="form-vertical" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="login-card mdl-card mdl-shadow--2dp">
      <div class="mdl-card__supporting-text" style="text-align: left">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('login') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="text" id="login" name="login" value="{{ old('login') }}" autofocus />
          <label class="mdl-textfield__label" for="login">{{ trans('label.login') }}</label>
          @if ($errors->has('login'))
          <span class="mdl-textfield__error">{{ $errors->first('login') }}</span>
          @endif
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('password') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="password" id="password" name="password" value="{{ old('password') }}" />
          <label class="mdl-textfield__label" for="password">{{ trans('label.password') }}</label>
          @if ($errors->has('password'))
          <span class="mdl-textfield__error">{{ $errors->first('password') }}</span>
          @endif
        </div>

        <div class="mdl-field">
          <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="remember">
            <input id="remember" type="checkbox" name="remember" class="mdl-switch__input" checked>
            <span class="mdl-switch__label">Remember Me</span>
          </label>
        </div>

      </div>
      <div class="mdl-card__actions mdl-card--border">
        <button type="submit" class="mdl-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-js-button mdl-js-ripple-effect">
          {{ trans('button.login') }}
        </button>
        <a href="{{ url('/password/reset') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
          Forgot Your Password?
        </a>
      </div>
    </div>
  </form>
  <div class="mdl-layout-spacer"></div>
</div>
<a href="{{ url('/register') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
  New user? <span class="mdl-button--accent">Create account</a>
  </a>
  @endsection
