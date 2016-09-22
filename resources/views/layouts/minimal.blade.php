@extends('layouts.skeleton')

@section('body')
<div class="minimal-layout mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-drawer-button">
  <header class="brand-header mdl-layout__header mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
      <div class="mdl-layout-spacer"></div>
      @include('widgets.logo')
      <div class="mdl-layout-spacer"></div>
    </div>
  </header>
  <div class="mdl-layout__content">
      @yield('content')
  </div>
</div>
@endsection
