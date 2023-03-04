<html lang="en">
<head>
    <title>Linky</title>

    {{
       Vite::useHotFile(app_path('vendor/linky/hot'))
           ->useBuildDirectory('vendor/linky/build')
           ->withEntryPoints(['resources/js/app.js'])
    }}
    @livewireScripts
    @livewireStyles
</head>
<body>

<x-linky::menu />

<div class="mx-auto mb-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    {{ $slot }}
</div>

</body>
</html>
