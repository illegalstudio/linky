<x-linky::layout>
    <x-linky::content-form
        method="POST"
        title="{{__('Create a link')}}"
        subtitle="{{__('Create a new link')}}"
        :action="route('linky.admin.link.store')"
        :backUrl="route('linky.admin.link.index')"
        :content="$link->content ?? null"
    >

        @include('linky::admin.link.form')

    </x-linky::content-form>
</x-linky::layout>
