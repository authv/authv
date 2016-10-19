@extends('layouts.app')

@section('content')
<div class="mdl-grid">
  <div class="mdl-layout-spacer"></div>
  <form class="form-vertical" role="form" method="POST" action="{{ route('complete-profile') }}">
    {{ csrf_field() }}

    <div class="register-card mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">One more step</h2>
      </div>
      <div class="mdl-card__supporting-text">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('name') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ old('name') ? old('name') : $name }}" autofocus />
          <label class="mdl-textfield__label" for="name">{{ trans('label.name') }}</label>
          @if ($errors->has('name'))
          <span class="mdl-textfield__error">{{ $errors->first('name') }}</span>
          @endif
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('username') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="text" id="username" name="username" value="{{ old('username') ? old('username') : $username }}" />
          <label class="mdl-textfield__label" for="username">{{ trans('label.username') }}</label>
          @if ($errors->has('username'))
          <span class="mdl-textfield__error">{{ $errors->first('username') }}</span>
          @endif
        </div>

        @if ($askEmail)
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('email') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}" />
          <label class="mdl-textfield__label" for="email">{{ trans('label.email') }}</label>
          @if ($errors->has('email'))
          <span class="mdl-textfield__error">{{ $errors->first('email') }}</span>
          @endif
        </div>
        @endif

        @if ($askPassword)
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('password') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="password" id="password" name="password" />
          <label class="mdl-textfield__label" for="password">{{ trans('label.password') }}</label>
          @if ($errors->has('password'))
          <span class="mdl-textfield__error">{{ $errors->first('password') }}</span>
          @endif
        </div>
        @endif

        <div class="mdl-card__actions">
          <button type="submit" class="mdl-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-js-button mdl-js-ripple-effect">
            {{  trans('button.register') }}
          </button>
        </div>

      </div>
    </div>
  </form>
  <div class="mdl-layout-spacer"></div>
</div>
@endsection
