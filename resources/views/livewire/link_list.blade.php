<div class="mt-8 flex flex-col">
    {{ $links->links() }}
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Public
                        </th>
                        <th scope="col" wire:click.prevent="sortBy('{{ $sortFields['name']  }}')"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 cursor-pointer hover:bg-gray-100">
                            Name
                        </th>
                        <th scope="col" wire:click.prevent="sortBy('{{ $sortFields['slug'] }}')"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 cursor-pointer hover:bg-gray-100">
                            Slug
                        </th>
                        <th scope="col" wire:click.prevent="sortBy('{{ $sortFields['url'] }}')"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 cursor-pointer hover:bg-gray-100">
                            URL
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($links as $link)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs sm:pl-6 text-gray-400">
                                {{ $link->id }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <span class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" role="switch" aria-checked="false">
                                    <span aria-hidden="true" class="pointer-events-none absolute h-full w-full rounded-md bg-white"></span>
                                    <span aria-hidden="true" class="{{ $link->content->public ? 'bg-indigo-600' : 'bg-gray-200' }} pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out"></span>
                                    <span aria-hidden="true" class="{{ $link->content->public ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out"></span>
                                </span>
                            </td>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                <div class="font-medium text-gray-900">{{ $link->content->name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900">{{ $link->content->slug }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900">{{ $link->url }}</div>
                            </td>
                            <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 my-auto">
                                <a href="{{ route('linky.admin.link.edit', $link)  }}"
                                   class="inline-block text-indigo-600 hover:text-indigo-900">
                                    <x-linky::icons.pencil-square/>
                                </a>
                                <form action="{{ route('linky.admin.link.destroy', $link) }}" method="POST"
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
