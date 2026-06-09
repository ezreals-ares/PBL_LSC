<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('home.sections._head')

<body class="overflow-x-hidden">
    <div id="swup" class="bg-surface text-on-surface font-jakarta">

        @include('home.sections._navbar')

        <main>
            @include('home.sections._hero')
            @include('home.sections._services')
            @include('home.sections._how-it-works')
            @include('home.sections._reviews')
            @include('home.sections._location')
        </main>

        @include('home.sections._footer')

    </div>

</body>
</html>
