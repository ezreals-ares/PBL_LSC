<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.welcome._head')

<body class="overflow-x-hidden">
    <div id="swup" class="bg-surface text-on-surface font-jakarta">

        @include('partials.welcome._navbar')

        <main>
            @include('partials.welcome._hero')
            @include('partials.welcome._services')
            @include('partials.welcome._how_it_works')
            @include('partials.welcome._reviews')
            @include('partials.welcome._location')
        </main>

        @include('partials.welcome._footer')

    </div>

</body>
</html>
