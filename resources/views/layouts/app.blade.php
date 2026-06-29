<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lesley Tabi — Backend Developer')</title>
    <meta name="description" content="Lesley Tabi — Backend Developer specializing in PHP and Laravel. Building reliable, well-structured web applications.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    @stack('styles')
</head>

<body>
    @yield('content')

    <script src="{{ asset('js/portfolio.js') }}" defer></script>
    @stack('scripts')
</body>

</html>