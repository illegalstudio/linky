<x-linky::layout>
    @include('linky::admin.link._parts.form', [
        'action' => route('linky.admin.link.store'),
        'method' => 'POST',
        'title' => 'Create link',
        'subtitle' => 'Create a new link',
    ])
</x-linky::layout>
