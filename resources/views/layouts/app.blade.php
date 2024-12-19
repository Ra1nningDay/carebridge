<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logos/logo-brand.png') }}">
   
<link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Flaticon CSS  --}}
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Splide CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css">
    
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    
    <!-- Font Awesome and Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

</head>
<body class="d-flex flex-column min-vh-100 bg-light font-sans antialiased">
    <!-- Navbar -->
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main> 

    {{-- <x-chat /> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll/dist/js/splide-extension-auto-scroll.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElements = document.querySelectorAll('.toast');
            toastElements.forEach(function (toastElement) {
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
            });
        });
    </script>
</body>
</html>
