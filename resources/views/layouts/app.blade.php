<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $siteUrl = rtrim(config('app.url'), '/');

        $headText = fn (string $value): string => html_entity_decode(trim($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $siteUrlFor = function (string $value, string $fallback) use ($siteUrl): string {
            $value = trim($value);

            if ($value === '') {
                return $fallback;
            }

            if (str_starts_with($value, '//')) {
                $value = 'https:' . $value;
            }

            $siteHost = parse_url($siteUrl, PHP_URL_HOST);
            $valueHost = parse_url($value, PHP_URL_HOST);
            $valuePath = parse_url($value, PHP_URL_PATH);

            if (!$valueHost && str_starts_with($value, '/')) {
                return $siteUrl . $value;
            }

            if ($valueHost && $siteHost && $valueHost === $siteHost && $valuePath) {
                $query = parse_url($value, PHP_URL_QUERY);

                return $siteUrl . $valuePath . ($query ? '?' . $query : '');
            }

            return $value;
        };

        $pageTitle       = $headText($__env->yieldContent('title', 'Lesley Tabi — Software Engineer | Laravel, PHP & Python Developer in Cameroon'));
        $pageDescription = $headText($__env->yieldContent('meta_description', 'Lesley Tabi is a Software Engineer based in Bamenda, Cameroon. He builds Laravel, PHP, Python, Livewire and React web applications for full-time, contract and remote work.'));
        $pageCanonical   = $siteUrlFor($__env->yieldContent('canonical', $siteUrl . '/'), $siteUrl . '/');
        $defaultImage    = $siteUrl . '/images/og-cover.png';
        $pageImage       = $siteUrlFor($__env->yieldContent('image', $defaultImage), $defaultImage);
        $pageImageAlt    = $headText($__env->yieldContent('image_alt', 'Lesley Tabi software engineer portfolio preview'));
        $profileImage    = file_exists(public_path('images/lesley-tabi.jpg'))
            ? $siteUrl . '/images/lesley-tabi.jpg'
            : $defaultImage;

        $pageImagePath      = parse_url($pageImage, PHP_URL_PATH);
        $pageImageLocalPath = $pageImagePath ? public_path(ltrim($pageImagePath, '/')) : null;
        $pageImageSize      = $pageImageLocalPath && file_exists($pageImageLocalPath) ? getimagesize($pageImageLocalPath) : null;
        $pageImageWidth     = $pageImageSize[0] ?? 1536;
        $pageImageHeight    = $pageImageSize[1] ?? 1024;
        $pageImageExtension = strtolower(pathinfo($pageImagePath ?? '', PATHINFO_EXTENSION));
        $pageImageType      = in_array($pageImageExtension, ['jpg', 'jpeg'], true) ? 'image/jpeg' : 'image/png';

        $schemaGraph = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => $siteUrl . '/#website',
                    'name' => 'Lesley Tabi',
                    'alternateName' => 'Lesley Tabi Portfolio',
                    'url' => $siteUrl . '/',
                    'publisher' => ['@id' => $siteUrl . '/#person'],
                    'inLanguage' => 'en',
                ],
                [
                    '@type' => 'Person',
                    '@id' => $siteUrl . '/#person',
                    'name' => 'Lesley Tabi',
                    'alternateName' => ['Lesley Tabi Software Engineer', 'Lesley Tabi Developer'],
                    'jobTitle' => 'Software Engineer',
                    'description' => 'Software Engineer based in Bamenda, Cameroon. Specializing in PHP, Laravel, Livewire and full-stack web development.',
                    'url' => $siteUrl . '/',
                    'mainEntityOfPage' => $siteUrl . '/',
                    'image' => [
                        '@type' => 'ImageObject',
                        'url' => $profileImage,
                        'caption' => 'Lesley Tabi, Software Engineer in Cameroon',
                    ],
                    'hasOccupation' => [
                        '@type' => 'Occupation',
                        'name' => 'Software Engineer',
                        'skills' => 'Laravel, PHP, Python, Livewire, React, MySQL, REST APIs',
                    ],
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'Bamenda',
                        'addressCountry' => 'CM',
                    ],
                    'email' => 'esanglesley@gmail.com',
                    'sameAs' => [
                        'https://github.com/Lesley-debug',
                        'https://www.linkedin.com/in/lesley-tabi-a0b1a1267',
                    ],
                    'knowsAbout' => ['PHP', 'Laravel', 'Livewire', 'MySQL', 'React', 'JavaScript', 'REST APIs', 'Docker'],
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $pageCanonical . '#webpage',
                    'url' => $pageCanonical,
                    'name' => $pageTitle,
                    'description' => $pageDescription,
                    'isPartOf' => ['@id' => $siteUrl . '/#website'],
                    'about' => ['@id' => $siteUrl . '/#person'],
                    'mainEntity' => ['@id' => $siteUrl . '/#person'],
                    'primaryImageOfPage' => [
                        '@type' => 'ImageObject',
                        'url' => $pageImage,
                        'width' => $pageImageWidth,
                        'height' => $pageImageHeight,
                        'caption' => $pageImageAlt,
                    ],
                    'inLanguage' => 'en',
                ],
            ],
        ];
    @endphp

    {{-- Primary SEO --}}
    <title>{{ $pageTitle }}</title>
    <meta name="description"  content="{{ $pageDescription }}">
    <meta name="keywords"     content="Lesley Tabi, Lesley, Leslie, Bamenda developer, Cameroon developer, Lesley developer, software engineer Cameroon, backend developer Cameroon, Laravel developer Cameroon, Python developer Cameroon, Bamenda developer, web developer Cameroon, full stack developer Cameroon, Laravel developer Africa, Python developer Africa, hire developer Cameroon, lesley tabi portfolio">
    <meta name="author"       content="Lesley Tabi">
    <meta name="robots"       content="index, follow, max-image-preview:large">
    <link rel="canonical"     href="{{ $pageCanonical }}">
    <link rel="image_src"     href="{{ $pageImage }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ $pageCanonical }}">
    <meta property="og:title"       content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image"       content="{{ $pageImage }}">
    <meta property="og:image:secure_url" content="{{ $pageImage }}">
    <meta property="og:image:type"  content="{{ $pageImageType }}">
    <meta property="og:image:width" content="{{ $pageImageWidth }}">
    <meta property="og:image:height" content="{{ $pageImageHeight }}">
    <meta property="og:image:alt"   content="{{ $pageImageAlt }}">
    <meta property="og:locale"      content="en_US">
    <meta property="og:site_name"   content="Lesley Tabi — Portfolio">

    {{-- Twitter / X --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image"       content="{{ $pageImage }}">
    <meta name="twitter:image:alt"   content="{{ $pageImageAlt }}">

    {{-- JSON-LD structured data --}}
    <script type="application/ld+json">
    {!! json_encode($schemaGraph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}?v={{ filemtime(public_path('css/portfolio.css')) }}">
    @stack('styles')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/favicon-48.png') }}" type="image/png" sizes="48x48">
    <link rel="icon" href="{{ asset('images/favicon-192.png') }}" type="image/png" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}" sizes="180x180">
    <meta name="theme-color" content="#0d1117">
</head>

<body>
    @yield('content')

    <script src="{{ asset('js/portfolio.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
