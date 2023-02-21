<header class="mb-10" x-data="{showMenu : false}">

    <div class="bg-indigo-600 ">
        <nav class="mx-auto max-w-7xl px-6 lg:px-8" aria-label="Top">
            <div
                class="flex flex-row-reverse sm:flex-row items-start sm:items-center w-full justify-between border-b border-indigo-500 py-6 lg:border-none">
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
                <div class="">
                    <a href="#"
                       class="inline-block rounded-md border border-transparent bg-indigo-500 py-2 px-4 text-base font-medium text-white hover:bg-opacity-75">
                        Logout
                    </a>
                    <!--<a href="#" class="inline-block rounded-md border border-transparent bg-white py-2 px-4 text-base font-medium text-indigo-600 hover:bg-indigo-50">Logout</a>-->
                </div>
            </div>
        </nav>

    </div>
    <div class="bg-indigo-600 mb-10 pb-4 px-0 pt-4 absolute w-full z-10" x-show="showMenu"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 "
         x-transition:enter-end="opacity-100 "
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 "
         x-transition:leave-end="opacity-0 "
         >
        <nav class="flex flex-col text-right gap-2">
            <a href="{{ route('linky.admin.link.index') }}"
               class="mx-4 px-4 py-2 text-base font-medium text-white hover:text-indigo-50 hover:bg-indigo-500 hover:rounded">Links</a>
            <a href="{{ route('linky.admin.collection.index') }}"
               class="mx-4 px-4 py-2 text-base font-medium text-white hover:text-indigo-50 hover:bg-indigo-500 hover:rounded">Collections</a>
            <a href="{{ route('linky.admin.page.index') }}"
               class="mx-4 px-4 py-2 text-base font-medium text-white hover:text-indigo-50 hover:bg-indigo-500 hover:rounded">Pages</a>
        </nav>
    </div>
</header>
