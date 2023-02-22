<x-linky::errors  />

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
                    <fieldset>
                        <legend class="contents text-base font-medium text-gray-900">Public</legend>
                        <div class="mt-4 space-y-4">
                            <button x-data="{toggle: {{ (old('public') ?? $content->public ?? 1) ? 'true' : 'false' }} }" @click="toggle = !toggle" type="button" class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" role="switch" aria-checked="false">
                                <input type="hidden" name="public" :value="toggle ? 1 : 0">
                                <span aria-hidden="true" class="pointer-events-none absolute h-full w-full rounded-md bg-white"></span>
                                <span aria-hidden="true" :class="toggle ? 'bg-indigo-600' : 'bg-gray-200'" class="pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out"></span>
                                <span aria-hidden="true" :class="toggle ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out"></span>
                            </button>
                        </div>
                    </fieldset>
                </div>

                <div>
                    <label for="slug" class="text-sm font-medium text-gray-700">Slug</label>
                    <div class="mt-1">
                        <input type="text" name="slug" id="slug"
                               class="w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ old('slug') ?? $content->slug ?? "" }}"
                               placeholder="">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Leave empty to get auto-generated slug</p>
                </div>

                <div>
                    <label for="name" class="text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name"
                               class="w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ old('name') ?? $content->name ?? "" }}"
                               placeholder="">
                    </div>
                </div>

                <div>
                    <label for="description" class="text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                            <textarea id="description" name="description" rows="3"
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="...">{{ old('description') ?? $content->description ?? "" }}</textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Brief description for this content</p>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ $backUrl }}"
           class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back</a>
        <button type="submit"
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Save
        </button>
    </div>
</form>
