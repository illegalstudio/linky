<html lang="en">
<head>
    <title>Linky</title>

    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body>

<header class="bg-indigo-600 mb-10">
    <nav class="mx-auto max-w-7xl px-6 lg:px-8" aria-label="Top">
        <div class="flex w-full items-center justify-between border-b border-indigo-500 py-6 lg:border-none">
            <div class="flex items-center">
                <a href="#">
                    <img class="h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=white" alt="">
                </a>
                <div class="ml-10 hidden space-x-8 lg:block">
                    <a href="{{ route('linky.admin.link.index') }}" class="text-base font-medium text-white hover:text-indigo-50">Links</a>
                    <a href="{{ route('linky.admin.collection.index') }}" class="text-base font-medium text-white hover:text-indigo-50">Collections</a>
                    <a href="{{ route('linky.admin.page.index') }}" class="text-base font-medium text-white hover:text-indigo-50">Pages</a>
                </div>
            </div>
            <div class="ml-10 space-x-4">
                <a href="#" class="inline-block rounded-md border border-transparent bg-indigo-500 py-2 px-4 text-base font-medium text-white hover:bg-opacity-75">Logout</a>
                <!--<a href="#" class="inline-block rounded-md border border-transparent bg-white py-2 px-4 text-base font-medium text-indigo-600 hover:bg-indigo-50">Logout</a>-->
            </div>
        </div>
        <div class="flex flex-wrap justify-center gap-x-6 py-4 lg:hidden">
            <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Links</a>
            <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Collections</a>
            <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Pages</a>
        </div>
    </nav>
</header>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    @yield('content')
</div>

@livewireScripts
</body>
</html>
