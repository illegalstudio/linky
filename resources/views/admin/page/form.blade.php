<div>
    <x-linky::input-label for="body">Body</x-linky::input-label>
    <x-linky::input-textarea id="body" name="body" rows="3" placeholder="..." class="mt-1">{{ old('body') ?? $page->body ?? "" }}</x-linky::input-textarea>
    <x-linky::input-description>The body or your page</x-linky::input-description>
</div>
