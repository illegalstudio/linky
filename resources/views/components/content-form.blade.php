<x-linky::errors/>

<form class="space-y-6" action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    <div class="bg-white px-4 py-5 border shadow  sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ $subtitle }}</p>
            </div>
            <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">
                <div>
                    <x-linky::input-label class="block">Public</x-linky::input-label>
                    <button
                        x-data="{toggle: {{ (old('public') ?? $content->public ?? 1) ? 'true' : 'false' }} }"
                        @click="toggle = !toggle" type="button"
                        class="mt-3 group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        role="switch" aria-checked="false">
                        <input type="hidden" name="public" :value="toggle ? 1 : 0">
                        <span aria-hidden="true"
                              class="pointer-events-none absolute h-full w-full rounded-md bg-white"></span>
                        <span aria-hidden="true" :class="toggle ? 'bg-indigo-600' : 'bg-gray-200'"
                              class="pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out"></span>
                        <span aria-hidden="true" :class="toggle ? 'translate-x-5' : 'translate-x-0'"
                              class="pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out"></span>
                    </button>
                </div>

                <div>
                    <x-linky::input-label for="slug">Slug</x-linky::input-label>
                    <x-linky::input-text type="text" name="slug" id="slug" class="mt-1" placeholder="" :value='old("slug") ?? $content->slug ?? ""'/>
                    <x-linky::input-description>Leave empty to get auto-generated slug</x-linky::input-description>
                </div>

                <div>
                    <x-linky::input-label for="name">Name</x-linky::input-label>
                    <x-linky::input-text type="text" name="name" id="name" class="mt-1" placeholder="" :value='old("name") ?? $content->name ?? ""'/>
                    <x-linky::input-description>The name for this content</x-linky::input-description>
                </div>

                <div>
                    <x-linky::input-label for="description">Description</x-linky::input-label>
                    <x-linky::input-textarea id="description" name="description" rows="3" placeholder="..." class="mt-1">{{ old('description') ?? $content->description ?? "" }}</x-linky::input-textarea>
                    <x-linky::input-description>Brief description for this content</x-linky::input-description>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <x-linky::button-a-white :href="$backUrl">Back</x-linky::button-a-white>
        <x-linky::button-primary class="ml-3">Save</x-linky::button-primary>
    </div>
</form>
