<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        @include('layouts.partials.nav')
        @include('layouts.partials.header')
        @include('layouts.partials.content')
{{--        @yield('content')--}}
        @include('layouts.partials.footer')
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
