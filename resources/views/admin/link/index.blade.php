@extends('linky::admin.layout')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Links</h1>
            <a href="{{ route('linky.admin.link.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="mt-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Slug</th>
                        <th class="px-4 py-2">Url</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($links as $link)
                        <tr>
                            <td class="border px-4 py-2">{{ $link->content->name }}</td>
                            <td class="border px-4 py-2">{{ $link->content->slug }}</td>
                            <td class="border px-4 py-2">{{ $link->url }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('linky.admin.link.edit', $link) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('linky.admin.link.destroy', $link) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
