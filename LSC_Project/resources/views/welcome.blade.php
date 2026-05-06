<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.welcome._head')

<body>

    @include('partials.welcome._navbar')

    @include('partials.welcome._hero')

    @include('partials.welcome._services')

    @include('partials.welcome._how_it_works')

    @include('partials.welcome._reviews')

    @include('partials.welcome._location')

    @include('partials.welcome._footer')

</body>
</html>
