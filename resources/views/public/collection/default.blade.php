@extends('linky::public.collection._layout')
@section('title')
    {{$collection->content->name}}
@endsection
@section('body')
    <div class="flex flex-col w-full h-full justify-center gap-4 bg-gray-50">
        @foreach($collection->contents as $content )
            <a class="w-[360px] max-w-md mx-auto bg-indigo-500 p-4 text-white rounded-md border-indigo-900 border-2 drop-shadow-md hover:bg-indigo-600"
                href="/{{ $content->slug }}" target="_blank">
                {{ $content->name ?: $content->slug }}
            </a>
        @endforeach
    </div>
@endsection
