<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKM UKDW | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.css') }}">
</head>

<body class="container-fluid vh-100 p-0">
    <div class="d-flex">
        @include('dashboard.assets.sidebar')
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand d-flex justify-content-between">
                <button class="toggler-btn" type="button">
                    <i class="fa-solid fa-outdent"></i>
                </button>
                <div class="user px-3">
                    <p class="secondary-color m-0">Selamat Datang! Kalistus Alvino <i class="fa-regular fa-face-smile-wink"></i></p>
                </div>
            </nav>
            <main class="p-3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sidebar.js')}}"></script>
</body>

</html>
