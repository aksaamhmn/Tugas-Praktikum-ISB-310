<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Dapur Takjil</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('assets/favicon.jpeg') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body class="d-flex flex-column min-vh-100">

    @include('partials.navbar')

    @yield('content')

    <footer class="bg-success text-white text-center py-3 mt-auto shadow-sm">
        <div class="container">
            <p class="mb-0">&copy; 2026 Sistem Manajemen Dapur Takjil</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>