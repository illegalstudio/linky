<div>
    <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
    <div class="mt-1">
                            <textarea id="body" name="body" rows="3"
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="...">{{ old('body') ?? $page->body ?? "" }}</textarea>
    </div>
    <p class="mt-2 text-sm text-gray-500">The body or your page</p>
</div>
