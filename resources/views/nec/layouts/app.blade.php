<!DOCTYPE html>
<html lang="en">
<head>
    @include('nec.partials.head')
</head>
<body>
    <div id="app" class="boxed-container">
        @include('cookieConsent::index')
        @include('nec.partials.header')
        @yield('content')
        @include('nec.partials.footer')
    </div>
    @include('nec.partials.js')
    @include('sweet::alert')
</body>
</html>