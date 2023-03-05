<div>
    <x-linky::input-label for="url">{{__('URL')}}</x-linky::input-label>
    <x-linky::input-text type="text" name="url" id="url" class="mt-1" placeholder="{{__('https://')}}" :value='old("url") ?? $link->url ?? ""' />
    <x-linky::input-description>{{__('URL for the link')}}</x-linky::input-description>
</div>
