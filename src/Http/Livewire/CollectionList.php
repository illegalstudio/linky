<?php

namespace Illegal\Linky\Http\Livewire;

use Exception;
use Illegal\Linky\Contracts\Livewire\Sortable;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Repositories\CollectionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionList extends Component
{
    use WithPagination, Sortable;

    /**
     * @var array $queryString The query string to persist
     */
    protected $queryString = [];

    /**
     * CollectionList constructor.
     *
     * @param null $id
     * @throws Exception
     */
    public function __construct($id = null)
    {
        $this->sortDefaultField = Collection::getField('created_at');
        $this->sortFields       = [
            'created_at' => Collection::getField('created_at'),
            'name'       => Content::getField('name'),
            'slug'       => Content::getField('slug')
        ];

        $this->queryString = [
            'sortField'     => ['except' => $this->sortDefaultField],
            'sortDirection' => ['except' => $this->sortDirection]
        ];

        parent::__construct($id);
    }

    /**
     * Render the view.
     *
     * @return Factory|View|Application
     * @throws Exception
     */
    public function render(CollectionRepository $collectionRepository): Factory|View|Application
    {
        return view('linky::livewire.collection_list', [
            'collections' => $collectionRepository->paginateWithContent(10, $this->getSort())
        ]);
    }

    /**
     * Get the pagination view.
     *
     * @return string
     */
    public function paginationView(): string
    {
        return 'linky::livewire._parts.paginator';
    }
}
