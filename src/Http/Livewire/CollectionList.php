<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Repositories\CollectionRepository;
use Illegal\Linky\Traits\Livewire\Sortable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionList extends Component
{
    use WithPagination, Sortable;

    protected $queryString = [];

    public function __construct($id = null)
    {
        $this->sortDefaultField = Collection::getField('created_at');
        $this->sortFields       = [
            'created_at' => Collection::getField('created_at'),
            'name'       => Content::getField('name'),
            'slug'       => Content::getField('slug')
        ];

        $this->queryString = [
            'sortField'     => ['except' => $this->sortField],
            'sortDirection' => ['except' => $this->sortDirection]
        ];

        parent::__construct($id);
    }

    public function render(): Factory|View|Application
    {
        return view('linky::livewire.collection_list', [
            'collections' => CollectionRepository::paginateWithContent(10, $this->getSort())
        ]);
    }

    public function paginationView(): string
    {
        return 'linky::livewire._parts.paginator';
    }
}
