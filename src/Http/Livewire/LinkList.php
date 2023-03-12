<?php

namespace Illegal\Linky\Http\Livewire;

use Exception;
use Illegal\Linky\Facades\Repositories\LinkRepository;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;
use Illegal\Linky\Traits\Livewire\Sortable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class LinkList extends Component
{
    use WithPagination, Sortable;

    /**
     * @var array $queryString The query string to persist
     */
    protected $queryString = [];

    /**
     * LinkList constructor.
     *
     * @param null $id
     * @throws Exception
     */
    public function __construct($id = null)
    {
        $this->sortDefaultField = Link::getField('created_at');
        $this->sortFields       = [
            'created_at' => Link::getField('created_at'),
            'url'        => Link::getField('url'),
            'name'       => Content::getField('name'),
            'slug'       => Content::getField('slug'),
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
     */
    public function render(): Factory|View|Application
    {
        return view('linky::livewire.link_list', [
            'links' => LinkRepository::paginateWithContent(10, $this->getSort())
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
