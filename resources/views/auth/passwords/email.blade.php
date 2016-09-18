@extends('layouts.app')

<!-- Main Content -->
@section('content')
@if (session('status'))
<show-snackbar message="{{ session('status') }}" timeout="10000"></show-snackbar>
@endif
<div class="mdl-grid">
  <div class="mdl-layout-spacer"></div>

  <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}

    <div class="reset-card mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Reset password</h2>
      </div>
      <div class="mdl-card__supporting-text">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ $errors->has('email') ? ' is-invalid' : '' }}">
          <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}" autofocus />
          <label class="mdl-textfield__label" for="email">{{ trans('label.email') }}</label>
          @if ($errors->has('email'))
          <span class="mdl-textfield__error">{{ $errors->first('email') }}</span>
          @endif
        </div>

      </div>

      <div class="mdl-card__actions">
        <button onclick="return false;" type="submit" class="mdl-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-js-button mdl-js-ripple-effect">
          {{ trans('button.send_password_reset') }}
        </button>
      </div>

    </div>
  </form>
  <div class="mdl-layout-spacer"></div>
</div>
@endsection
