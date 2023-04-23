<html lang="en">
<head>
    <title>@yield('title', 'Linky')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ Vite::useHotFile(base_path() . '/vendor/illegal/linky/public/hot')->useBuildDirectory('vendor/illegal/linky')->withEntryPoints([ 'resources/css/app.scss' ]) }}
</head>
<body>
@yield('body')
@vite('resources/js/app.js', 'vendor/illegal/linky')
</body>
</html>
