@props(['disabled' => false])

<textarea {{ $disabled ? '$disabled' : '' }}
    {!! $attributes->merge(['class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) !!}
>{{ $slot }}</textarea>

