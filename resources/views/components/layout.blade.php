<html lang="en">
<head>
    <title>Linky</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ Vite::useHotFile(base_path() . '/vendor/illegal/linky/public/hot')->useBuildDirectory('vendor/illegal/linky')->withEntryPoints([ 'resources/css/app.scss' ]) }}
    @livewireStyles
</head>
<body>

<x-linky::menu />

<div class="mx-auto mb-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    {{ $slot }}
</div>

{{ Vite::useHotFile(base_path() . '/vendor/illegal/linky/public/hot')->useBuildDirectory('vendor/illegal/linky')->withEntryPoints([ 'resources/js/app.js' ]) }}
@livewireScripts
</body>
</html>
