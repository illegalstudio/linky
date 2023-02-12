@extends('linky::admin.layout')

@section('content')
    @include('linky::admin.link._parts.form', [
        'action' => route('linky.admin.link.store'),
        'title' => 'Create link',
        'subtitle' => 'Create a new link',
    ])
@endsection
