<div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
    <div class="md:grid md:grid-cols-2 md:gap-6">
        <div class="md:col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Add content</h3>
            <p class="mt-1 text-sm text-gray-500">Search content to be added</p>
            <hr class="my-5">

            <div class="w-full">
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <div class="mt-1">
                    <input type="text" name="search" id="search"
                           wire:model.defer="searchAvailableContentsString" wire:keydown.enter="searchAvailableContentsAction"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="Press enter after your search">
                </div>
            </div>

            <div class="mt-5 space-y-3">
                @foreach($availableContents as $content)
                    <div
                        class="relative flex justify-between rounded-lg border border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $content->name }} </p>
                            <p class="text-xs text-gray-600">{{ $content->type }} - <a href="#" target="_blank">/{{ $content->slug }}</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" wire:click="addContentAction({{ $content }})"
                                    class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <x-linky::icons.double-arrow-right/>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="md:col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Current contents</h3>
            <p class="mt-1 text-sm text-gray-500">Contents assigned to this collection</p>
            <hr class="my-5">

            <div class="w-full">
                <label for="filter" class="block text-sm font-medium text-gray-700">Filter</label>
                <div class="mt-1">
                    <input type="text" name="filter" id="filter"
                           wire:model.defer="filterCurrentContentsString" wire:keydown.enter="filterCurrentContentsAction"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="Press enter after your search">
                </div>
            </div>

            <div class="mt-5 space-y-3">
                @foreach($currentContents as $content)
                    <div
                        class="relative flex justify-between rounded-lg border border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $content->name }} </p>
                            <p class="text-xs text-gray-600">{{ $content->type }} - <a href="#" target="_blank">/{{ $content->slug }}</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" wire:click="removeContentAction({{ $content }})"
                                    class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <x-linky::icons.x-mark/>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
