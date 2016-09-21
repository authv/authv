@extends('layouts.app')

@section('content')
<div class="mdl-grid">
  <div class="mdl-layout-spacer"></div>
  <form class="form-vertical" role="form" method="POST" action="{{ url('/password/reset') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="reset-card mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Reset password</h2>
      </div>
      <div class="mdl-card__supporting-text">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('email') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ $email or old('email') }}" autofocus />
          <label class="mdl-textfield__label" for="email">{{ trans('label.email') }}</label>
          @if ($errors->has('email'))
          <span class="mdl-textfield__error">{{ $errors->first('email') }}</span>
          @endif
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('password') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="password" id="password" name="password" />
          <label class="mdl-textfield__label" for="password">{{ trans('label.password') }}</label>
          @if ($errors->has('password'))
          <span class="mdl-textfield__error">{{ $errors->first('password') }}</span>
          @endif
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="password" id="password-confirm" name="password_confirmation" />
          <label class="mdl-textfield__label" for="password">{{ trans('label.password_confirmation') }}</label>
          @if ($errors->has('password_confirmation'))
          <span class="mdl-textfield__error">{{ $errors->first('password_confirmation') }}</span>
          @endif
        </div>

        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
              {{ trans('button.reset_password') }}
            </button>
          </div>
        </div>

      </div>
    </div>

  </form>

</div>
@endsection
