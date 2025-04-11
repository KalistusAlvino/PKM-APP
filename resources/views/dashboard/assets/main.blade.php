<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

      <!-- Font awesome icons -->
      <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.css') }}">


      <!-- Sweet Alert CSS -->
      <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    @include('dashboard.assets.header')
    @switch(Auth::user()->role)
    @case('mahasiswa')
        @include('dashboard.assets.sidebar-mahasiswa')
        @break

    @case('dosen')
        @include('dashboard.assets.sidebar-dosen')
        @break
    @case('koordinator')
        @include('dashboard.assets.sidebar-koordinator')
        @break
    @case('biro')
        @include('dashboard.assets.sidebar-biro')
        @break
    @endswitch
    <main id="main" class="main">
        @yield('content')
    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Template Main JS File -->
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sidebar.js')}}"></script>

    <!-- Sweetalert2 JS File -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <!-- Swallfire -->
    <script>
        @if(session('success'))
        const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}",
                });
        @elseif($errors->any())
            console.log("Errors:", @json($errors->all()));
            let errorMessages = @json($errors->all());
            let errorText = errorMessages.join("<br>");

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                html: errorText
            });
        @endif
    </script>

</body>

</html>
