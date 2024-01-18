<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    @include('lib.partials.head')
</head>

<body>
    <header>
        @include('lib.partials.navbar')

        @yield('hero')
    </header>

    <main>
        <div class="px-4 py-28 md:px-10 lg:px-20">
            @yield('main-content')
        </div>
    </main>

    @include('lib.partials.footer')

    @include('lib.partials.components')
</body>

</html>
