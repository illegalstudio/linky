@extends('linky::admin.layout')

@section('content')
    @include('linky::admin.collection._parts.form', [
        'action' => route('linky.admin.collection.update', $collection),
        'method' => 'PUT',
        'title' => 'Update collection',
        'subtitle' => 'Update existing collection',
    ])

    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Add content</h3>
                <p class="mt-1 text-sm text-gray-500">Search content to be added</p>
                <hr class="my-5">

                <div class="w-full">
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <div class="mt-1">
                        <input type="text" name="search" id="search" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="...">
                    </div>
                </div>

                <div class="mt-5 space-y-3">
                    <div class="relative flex justify-between rounded-lg border-2 border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Qualcosa </p>
                            <p class="text-xs text-gray-600">Link - <a href="#" target="_blank">/slug</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.21 14.77a.75.75 0 01.02-1.06L14.168 10 10.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M4.21 14.77a.75.75 0 01.02-1.06L8.168 10 4.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative flex justify-between rounded-lg border-2 border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Qualcosa</p>
                            <p class="text-xs text-gray-600">Link - <a href="#" target="_blank">/slug</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.21 14.77a.75.75 0 01.02-1.06L14.168 10 10.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M4.21 14.77a.75.75 0 01.02-1.06L8.168 10 4.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative flex justify-between rounded-lg border-2 border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Qualcosa</p>
                            <p class="text-xs text-gray-600">Link - <a href="#" target="_blank">/slug</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.21 14.77a.75.75 0 01.02-1.06L14.168 10 10.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M4.21 14.77a.75.75 0 01.02-1.06L8.168 10 4.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Current contents</h3>
                <p class="mt-1 text-sm text-gray-500">Contents assigned to this collection</p>
                <hr class="my-5">

                <div class="w-full">
                    <label for="filter" class="block text-sm font-medium text-gray-700">Filter</label>
                    <div class="mt-1">
                        <input type="text" name="filter" id="filter" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="...">
                    </div>
                </div>

                <div class="mt-5 space-y-3">
                    <div class="relative flex justify-between rounded-lg border-2 border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Qualcosa</p>
                            <p class="text-xs text-gray-600">Link - <a href="#" target="_blank">/slug</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <!-- Heroicon name: mini/x-mark -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative flex justify-between rounded-lg border-2 border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Qualcosa</p>
                            <p class="text-xs text-gray-600">Link - <a href="#" target="_blank">/slug</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <!-- Heroicon name: mini/x-mark -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative flex justify-between rounded-lg border-2 border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-indigo-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Qualcosa</p>
                            <p class="text-xs text-gray-600">Link - <a href="#" target="_blank">/slug</a></p>
                        </div>
                        <div class="my-auto pl-4">
                            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <!-- Heroicon name: mini/x-mark -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
