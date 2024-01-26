<!DOCTYPE html>
<html lang="en">

<head>
    <title>BookSaw - Free Book Store HTML CSS Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('booksaw') }}/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('booksaw') }}/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('booksaw') }}/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('booksaw') }}/style.css">

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    @include('frontend.partials.header') <!-- Include header -->

    <main>
        @yield('content') <!-- Main content section -->
    </main>

    @include('frontend.partials.footer') <!-- Include footer -->
    @stack('scripts')
    <!-- Scripts -->
</body>

</html>
