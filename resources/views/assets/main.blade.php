<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

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
    <!-- Tambahkan SweetAlert2 -->
    <!-- Sweetalert2 JS File -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
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
        @elseif(session()->has('errors'))
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
