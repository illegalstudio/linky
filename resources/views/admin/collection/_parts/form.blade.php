@include('linky::admin._parts.errors')

<form class="space-y-6" action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ $subtitle }}</p>
            </div>
            <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name"
                               class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ old('name') ?? $collection->content->name ?? "" }}"
                               placeholder="">
                    </div>
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <div class="mt-1">
                        <input type="text" name="slug" id="slug"
                               class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ old('slug') ?? $collection->content->slug ?? "" }}"
                               placeholder="">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Leave empty to get auto-generated slug</p>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                            <textarea id="description" name="description" rows="3"
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="...">{{ old('description') ?? $collection->content->description ?? "" }}</textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Brief description for your collection</p>
                </div>

                <div>
                    <fieldset>
                        <legend class="contents text-base font-medium text-gray-900">Status</legend>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center">
                                <input id="status-draft" name="status" type="radio" value="draft"
                                       class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" @if ((old('status') ?? $collection->content->status->value ?? "draft") == "draft") checked @endif>
                                <label for="status-draft" class="ml-3 block text-sm font-medium text-gray-700">Draft</label>
                            </div>
                            <div class="flex items-center">
                                <input id="status-active" name="status" type="radio" value="active"
                                       class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" @if ((old('status') ?? $collection->content->status->value ?? "draft") == "active") checked @endif>
                                <label for="status-active" class="ml-3 block text-sm font-medium text-gray-700">Active</label>
                            </div>
                            <div class="flex items-center">
                                <input id="status-archived" name="status" type="radio" value="archived"
                                       class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" @if ((old('status') ?? $collection->content->status->value ?? "draft") == "archived") checked @endif>
                                <label for="status-archived" class="ml-3 block text-sm font-medium text-gray-700">Archived</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('linky.admin.collection.index') }}"
           class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back</a>
        <button type="submit"
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Save
        </button>
    </div>
</form>
