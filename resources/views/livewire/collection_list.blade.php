<div class="mt-8 flex flex-col">
    {{ $collections->links() }}
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                        </th>
                        <th scope="col" wire:click.prevent="sortBy('{{ $sortFields['name']  }}')"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 cursor-pointer hover:bg-gray-100">
                            Name
                        </th>
                        <th scope="col" wire:click.prevent="sortBy('{{ $sortFields['slug']  }}')"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 cursor-pointer hover:bg-gray-100">
                            Slug
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Public
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($collections as $collection)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs sm:pl-6 text-gray-400">
                                {{ $collection->id }}
                            </td>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                <div class="font-medium text-gray-900">{{ $collection->content->name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900">{{ $collection->content->slug }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">{{ $collection->content->public }}</span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('linky.admin.collection.edit', $collection)  }}"
                                   class="inline-block text-indigo-600 hover:text-indigo-900">
                                    <x-linky::icons.pencil-square/>
                                </a>
                                <form action="{{ route('linky.admin.collection.destroy', $collection) }}" method="POST"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                        <x-linky::icons.trash/>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
