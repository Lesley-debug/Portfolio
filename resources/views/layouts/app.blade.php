<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $pageTitle       = trim($__env->yieldContent('title', 'Lesley Tabi — Software Engineer | Laravel & PHP Developer in Cameroon'));
        $pageDescription = trim($__env->yieldContent('meta_description', 'Lesley Tabi is a Software Engineer based in Bamenda, Cameroon. Specializing in PHP, Laravel, Livewire and full-stack web development. Available for full-time, contract and remote work.'));
        $pageCanonical   = trim($__env->yieldContent('canonical', config('app.url')));
    @endphp

    {{-- Primary SEO --}}
    <title>{{ $pageTitle }}</title>
    <meta name="description"  content="{{ $pageDescription }}">
    <meta name="keywords"     content="Lesley Tabi, software engineer Cameroon, backend developer Cameroon, Laravel developer Cameroon, PHP developer Cameroon, Bamenda developer, web developer Cameroon, full stack developer Cameroon, Laravel developer Africa, PHP developer Africa, hire developer Cameroon, lesley tabi portfolio">
    <meta name="author"       content="Lesley Tabi">
    <meta name="robots"       content="index, follow">
    <link rel="canonical"     href="{{ $pageCanonical }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ $pageCanonical }}">
    <meta property="og:title"       content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image"       content="{{ asset('images/og-cover.png') }}">
    <meta property="og:locale"      content="en_US">
    <meta property="og:site_name"   content="Lesley Tabi — Portfolio">

    {{-- Twitter / X --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image"       content="{{ asset('images/og-cover.png') }}">

    {{-- JSON-LD structured data --}}
    <script type="application/ld+json">
    @verbatim
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Lesley Tabi",
      "jobTitle": "Software Engineer",
      "description": "Software Engineer based in Bamenda, Cameroon. Specializing in PHP, Laravel, Livewire and full-stack web development.",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Bamenda",
        "addressCountry": "CM"
      },
      "email": "esanglesley@gmail.com",
      "sameAs": [
        "https://github.com/Lesley-debug",
        "https://www.linkedin.com/in/lesley-tabi-a0b1a1267"
      ],
      "knowsAbout": ["PHP", "Laravel", "Livewire", "MySQL", "React", "JavaScript", "REST APIs", "Docker"]
    }
    @endverbatim
    </script>

    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}?v={{ filemtime(public_path('css/portfolio.css')) }}">
    @stack('styles')
</head>

<body>
    @yield('content')

    <script src="{{ asset('js/portfolio.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
