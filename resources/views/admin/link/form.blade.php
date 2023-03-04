<div>
    <x-linky::input-label for="url">URL</x-linky::input-label>
    <x-linky::input-text type="text" name="url" id="url" class="mt-1" placeholder="https://" :value='old("url") ?? $link->url ?? ""' />
    <x-linky::input-description>URL for the link</x-linky::input-description>
</div>
