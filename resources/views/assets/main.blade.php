<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.css') }}">


</head>

<body>
    <header class="sticky-top">
        @include('assets.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('assets.footer')
    </footer>


    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
