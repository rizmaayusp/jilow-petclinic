<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jilow Pet Clinic')</title>

    <!-- link bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

    {{-- link CDN Icon Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- font awesome cdn link  -->
    {{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" integrity="sha384-ePCe4V4Pphz2XxYzX3ewLoeRPPi8OONF4G5p8RkzQz6Nl3Hep2udRaXW2H6kkxHv" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap");
        /* @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap'); */
    </style>
</head>

<body>
    <!-- Navbar start -->
    @include('layouts.navbar')
    <!-- Navbar end -->

    {{-- Main Hero Section --}}
    @include('partials.main-hero')

    {{-- Konten Website Section --}}
    @yield('content')

    <!-- footer -->
    @include('layouts.footer')

    <!-- Include Bootstrap JS and dependencies (e.g., Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <!-- Optional: Swiper JS -->
    <script src="{{ asset('javascript/script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://pro.fontawesome.com/releases/v6.0.0-beta1/js/all.js" integrity="sha384-JzF4qc8tfZpQ/lQPxudG2ldFjrV+4TJ5SFI3JLJaeumkXnZdRR8rGGJ0XeG5DLjT" crossorigin="anonymous"></script>
</body>
</html>
