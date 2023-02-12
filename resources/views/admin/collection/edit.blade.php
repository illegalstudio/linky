@extends('linky::admin.layout')

@section('content')
    @include('linky::admin.collection._parts.form', [
        'action' => route('linky.admin.collection.update', $link),
        'method' => 'PUT',
        'title' => 'Update collection',
        'subtitle' => 'Update existing collection',
    ])
@endsection
