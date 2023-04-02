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
                <div class="hidden space-x-8 sm:flex flex-row">
                    <x-linky::menu-link href="{{ route('linky.admin.link.index') }}">Links</x-linky::menu-link>
                    <x-linky::menu-link href="{{ route('linky.admin.collection.index') }}">Collections
                    </x-linky::menu-link>
                    <x-linky::menu-link href="{{ route('linky.admin.page.index') }}">Pages</x-linky::menu-link>
                    @if(insideauth_booted())
                        @if (insideauth()->user_profile_enabled)
                            <x-linky::menu-link href="{{ route(insideauth()->route_profile_edit) }}">Profile
                            </x-linky::menu-link>
                        @endif
                    @endif
                </div>
                <div class="">
                    @if(config('linky.auth.require_valid_user'))
                        @if(insideauth_booted())
                            @guest(insideauth()->security_guard)
                                <x-linky::menu-button-a href="{{ route(insideauth()->route_login) }}">Log in
                                </x-linky::menu-button-a>
                            @endguest
                            @auth(insideauth()->security_guard)
                                <form method="POST" action="{{ route(insideauth()->route_logout) }}">
                                    @csrf
                                    <x-linky::menu-button>Logout</x-linky::menu-button>
                                </form>
                            @endauth
                        @else
                            @auth()
                                @if(Route::has('logout'))
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-linky::menu-button>Logout</x-linky::menu-button>
                                    </form>
                                @endif
                            @endauth
                        @endif
                    @endif
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
            <x-linky::menu-link-mobile href="{{ route('linky.admin.link.index') }}">Links</x-linky::menu-link-mobile>
            <x-linky::menu-link-mobile href="{{ route('linky.admin.collection.index') }}">Collections
            </x-linky::menu-link-mobile>
            <x-linky::menu-link-mobile href="{{ route('linky.admin.page.index') }}">Pages</x-linky::menu-link-mobile>
            @if (Route::has('linky.auth.profile.edit'))
                <x-linky::menu-link-mobile href="{{ route('linky.auth.profile.edit') }}">Profile
                </x-linky::menu-link-mobile>
            @endif
        </nav>
    </div>
</header>
