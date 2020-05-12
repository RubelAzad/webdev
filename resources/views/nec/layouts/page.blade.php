<!DOCTYPE html>
<html lang="en">
<head>
    @include('nec.partials.head')
</head>
<body>
<div id="app" class="boxed-container">
    @include('nec.partials.header')
    @include('nec.partials.page-title')
    @include('nec.partials.breadcrumb')
    <div class="container">
        @yield('content')
    </div>
    @include('nec.partials.footer')
</div>
@include('nec.partials.js')
@include('sweet::alert')
</body>
</html>