@extends('linky::admin.layout')

@section('content')
    @include('linky::admin.page._parts.form', [
        'action' => route('linky.admin.page.update', $page),
        'method' => 'PUT',
        'title' => 'Update page',
        'subtitle' => 'Update existing page',
    ])
@endsection
