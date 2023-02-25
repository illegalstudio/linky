<x-linky::layout>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Collections</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the collections in your account</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <x-linky::button-a-primary type="button" :href="route('linky.admin.collection.create')">
                Add collection
            </x-linky::button-a-primary>
        </div>
    </div>

    @livewire('linky::collection-list')
</x-linky::layout>
