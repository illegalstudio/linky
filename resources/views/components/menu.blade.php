<header class="bg-indigo-600 mb-10">
    <nav class="mx-auto max-w-7xl px-6 lg:px-8"  x-data="{showMenu : false}" aria-label="Top">
        <div class="flex flex-row items-start sm:items-center w-full justify-between border-b border-indigo-500 py-6 lg:border-none">
            <div class="sm:hidden">
                <button @click.prevent="showMenu = !showMenu " class="flex justify-between text-white">
                    <svg x-show="!showMenu" class="w-10 h-10 mr-2" fill="none" stroke-linecap="round"
                         stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="showMenu" class="w-10 h-10 mr-2" fill="none" stroke-linecap="round"
                         stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="white">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="">
                <a href="#">
                    <img class="h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=white" alt="">
                </a>
            </div>
            <div class="ml-10 hidden space-x-8 sm:flex flex-row">
                <a href="{{ route('linky.admin.link.index') }}"
                   class="text-base font-medium text-white hover:text-indigo-50">Links</a>
                <a href="{{ route('linky.admin.collection.index') }}"
                   class="text-base font-medium text-white hover:text-indigo-50">Collections</a>
                <a href="{{ route('linky.admin.page.index') }}"
                   class="text-base font-medium text-white hover:text-indigo-50">Pages</a>
            </div>
            <div class="ml-10 space-x-4">
                <a href="#"
                   class="inline-block rounded-md border border-transparent bg-indigo-500 py-2 px-4 text-base font-medium text-white hover:bg-opacity-75">Logout</a>
                <!--<a href="#" class="inline-block rounded-md border border-transparent bg-white py-2 px-4 text-base font-medium text-indigo-600 hover:bg-indigo-50">Logout</a>-->
            </div>
        </div>
        <div class="pb-4 pt-4" x-show="showMenu" x-transition.duration.200ms>
            <nav class="flex flex-col gap-2">
                <a href="{{ route('linky.admin.link.index') }}"
                   class="text-base font-medium text-white hover:text-indigo-50">Links</a>
                <a href="{{ route('linky.admin.collection.index') }}"
                   class="text-base font-medium text-white hover:text-indigo-50">Collections</a>
                <a href="{{ route('linky.admin.page.index') }}"
                   class="text-base font-medium text-white hover:text-indigo-50">Pages</a>
            </nav>
        </div>
    </nav>
</header>
