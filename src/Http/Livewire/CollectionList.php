<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionList extends Component
{
    use WithPagination;

    public function render(): Factory|View|Application
    {
        return view('linky::livewire.collection_list', [
            'collections' => Collection::with('content')->paginate(10),
        ]);
    }

    public function paginationView(): string
    {
        return 'linky::livewire._parts.paginator';
    }
}
