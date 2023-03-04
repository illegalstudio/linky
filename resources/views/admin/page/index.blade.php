<x-linky::layout>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Pages</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the pages in your account</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <x-linky::button-a-primary type="button" :href="route('linky.admin.page.create')">
                Add page
            </x-linky::button-a-primary>
        </div>
    </div>

    @livewire('linky::page-list')
</x-linky::layout>
