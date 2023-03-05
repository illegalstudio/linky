<x-linky::layout>
    <x-linky::content-form
        method="PUT"
        title="{{__('Update collection')}}"
        subtitle="{{__('Update existing collection')}}"
        :action="route('linky.admin.collection.update', $collection)"
        :backUrl="route('linky.admin.collection.index')"
        :content="$collection->content ?? null"
    >

        @include('linky::admin.collection.form')

    </x-linky::content-form>

    @livewire('linky::collection-content-manager', ['collection' => $collection])

</x-linky::layout>
