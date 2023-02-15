<x-linky::layout>
    @include('linky::admin.collection._parts.form', [
        'action' => route('linky.admin.collection.store'),
        'method' => 'POST',
        'title' => 'Create collection',
        'subtitle' => 'Create a new collection',
    ])
</x-linky::layout>
