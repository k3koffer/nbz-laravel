<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ $page['props']['meta']['title'] . ' | ' . config('app.name', 'Laravel') }}</title>
        <meta name="description" content="{{ $page['props']['meta']['description']}}" inertia>
        
        <!-- Open Graph теги для соцсетей -->
        <meta property="og:title" content="{{ $page['props']['meta']['title']  . ' | ' .  config('app.name', 'Laravel') }}" inertia>
        <meta property="og:description" content="{{ $page['props']['meta']['description']}}" inertia>
        <meta property="og:image" content="https://ik.imagekit.io/3dwnck0ax{{ $page['props']['meta']['image']}}" inertia>
        <meta property="og:url" content="{{ $page['props']['meta']['url'] }}" inertia>
        <meta property="og:type" content="{{ $page['props']['meta']['type'] }}" inertia>
        <meta property="og:site_name" content="НеБойсяЗнать - образовательная платформа" inertia>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <script defer src="https://kit.fontawesome.com/19116f7e3a.js" crossorigin="anonymous"></script>

        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap">
        </noscript>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Main/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
