<x-linky::layout>
    @include('linky::admin.collection._parts.form', [
        'action' => route('linky.admin.collection.update', $collection),
        'method' => 'PUT',
        'title' => 'Update collection',
        'subtitle' => 'Update existing collection',
    ])

    @livewire('linky::collection-content-manager', ['collection' => $collection])
</x-linky::layout>
