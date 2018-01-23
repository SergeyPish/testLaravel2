<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('include.head')
<body>
<div class="wrapper">
    @include('include.header')

    @yield('content')

    @include('include.footer')
</div>
</body>
</html>