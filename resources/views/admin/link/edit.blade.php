<x-linky::layout>
    @include('linky::admin.link._parts.form', [
        'action' => route('linky.admin.link.update', $link),
        'method' => 'PUT',
        'title' => 'Update link',
        'subtitle' => 'Update existing link',
    ])
</x-linky::layout>
