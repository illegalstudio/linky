@extends('linky::admin.layout')

@section('content')
    @include('linky::admin.page._parts.form', [
        'action' => route('linky.admin.page.store'),
        'method' => 'POST',
        'title' => 'Create page',
        'subtitle' => 'Create a new page',
    ])
@endsection
