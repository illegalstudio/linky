<div>
    <label for="url" class="text-sm font-medium text-gray-700">URL</label>
    <div class="mt-1">
        <input type="text" name="url" id="url"
               class="w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
               value="{{ old('url') ?? $link->url ?? "" }}"
               placeholder="https://">
    </div>
</div>
