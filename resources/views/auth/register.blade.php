@extends('layouts.minimal')

@section('content')
<h4 class="h-m-top--sm">Create a free account</h4>
<a href="{{ url('/login') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
  Existing user? <span class="mdl-button--primary">Sign in</span>
</a>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-grid">
      <div class="mdl-layout-spacer"></div>
      <form class="form-vertical" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <div class="register-card mdl-card mdl-shadow--2dp">
          <div class="mdl-card__supporting-text">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('name') ? ' is-invalid' : '' }}">
              <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ old('name') }}" autofocus />
              <label class="mdl-textfield__label" for="name">{{ trans('label.name') }}</label>
              @if ($errors->has('name'))
              <span class="mdl-textfield__error">{{ $errors->first('name') }}</span>
              @endif
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('username') ? ' is-invalid' : '' }}">
              <input class="mdl-textfield__input" type="text" id="username" name="username" value="{{ old('username') }}" />
              <label class="mdl-textfield__label" for="username">{{ trans('label.username') }}</label>
              @if ($errors->has('username'))
              <span class="mdl-textfield__error">{{ $errors->first('username') }}</span>
              @endif
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('email') ? ' is-invalid' : '' }}">
              <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}" />
              <label class="mdl-textfield__label" for="email">{{ trans('label.email') }}</label>
              @if ($errors->has('email'))
              <span class="mdl-textfield__error">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('password') ? ' is-invalid' : '' }}">
              <input class="mdl-textfield__input" type="password" id="password" name="password" value="{{ old('password') }}" />
              <label class="mdl-textfield__label" for="password">{{ trans('label.password') }}</label>
              @if ($errors->has('password'))
              <span class="mdl-textfield__error">{{ $errors->first('password') }}</span>
              @endif
            </div>

            {!! Authv::immigrationFields() !!}

            <div class="mdl-card__actions">
              <button type="submit" class="mdl-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-js-button mdl-js-ripple-effect">
                {{  trans('button.register') }}
              </button>
            </div>

          </form>
        </div>
      </div>
      <div class="mdl-layout-spacer mdl-layout--tablet mdl-layout--mobile"></div>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--1-col-desktop mdl-layout--desktop">
  </div>
  <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-grid">
      @include('auth.social')
      <div class="mdl-layout-spacer mdl-layout--desktop"></div>
    </div>
  </div>
</div>
@endsection
