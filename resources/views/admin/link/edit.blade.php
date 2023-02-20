<x-linky::layout>
    <x-linky::content-form
        method="PUT"
        title="Update link"
        subtitle="Update existing link"
        :action="route('linky.admin.link.update', $link)"
        :backUrl="route('linky.admin.link.index')"
        :content="$link->content ?? null"
    >

        @include('linky::admin.link.form')

    </x-linky::content-form>
</x-linky::layout>
