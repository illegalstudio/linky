<x-linky::layout>
    <x-linky::content-form
        method="PUT"
        title="Update page"
        subtitle="Update existing page"
        :action="route('linky.admin.page.update', $page)"
        :backUrl="route('linky.admin.page.index')"
        :content="$page->content ?? null"
    >

        @include('linky::admin.page.form')

    </x-linky::content-form>
</x-linky::layout>
