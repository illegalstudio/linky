<x-linky::layout>
    <x-linky::content-form
        method="POST"
        title="{{__('Create collection')}}"
        subtitle="{{__('Create a new collection')}}"
        :action="route('linky.admin.collection.store')"
        :backUrl="route('linky.admin.collection.index')"
        :content="$link->content ?? null"
    >

        @include('linky::admin.collection.form')

    </x-linky::content-form>
</x-linky::layout>
