@extends('layouts.skeleton')

@section('body')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-drawer-button">
  <header class="brand-header mdl-layout__header">
    <div class="mdl-layout__header-row">
      @include('widgets.logo')
      <!-- Add spacer, to align navigation to the right in desktop -->
      <div class="mdl-layout-spacer"></div>
      <div class="brand-navigation-container">
        <nav class="brand-navigation mdl-navigation">
          @if (Auth::guest())
          <a class="mdl-navigation__link mdl-typography--text-uppercase" href="{{ url('/login') }}">Login</a>
          <a class="mdl-navigation__link mdl-typography--text-uppercase" href="{{ url('/register') }}">Register</a>
          @endif
        </nav>
      </div>
      @if (Auth::user())
      <button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="more-button">
        {{ Auth::user()->name }}
      </button>
      <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="more-button">
        <li class="mdl-menu__item">
          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
      @endif
    </div>
  </header>
  <div class="mdl-layout__content">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
      <div class="page-content mdl-cell mdl-cell--10-col">
        @yield('content')
      </div>
    </div>
  </div>
</div>
@endsection
