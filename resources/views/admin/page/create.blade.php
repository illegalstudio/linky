<x-linky::layout>
    <x-linky::content-form
        method="POST"
        title="{{__('Create page')}}"
        subtitle="{{__('Create a new page')}}"
        :action="route('linky.admin.page.store')"
        :backUrl="route('linky.admin.page.index')"
        :content="$page->content ?? null"
    >

        @include('linky::admin.page.form')

    </x-linky::content-form>
</x-linky::layout>
