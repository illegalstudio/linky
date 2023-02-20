<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;
use Illegal\Linky\Repositories\PageRepository;
use Illegal\Linky\Traits\Livewire\Sortable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PageList extends Component
{
    use WithPagination, Sortable;

    /**
     * @var array $queryString The query string to persist
     */
    protected $queryString = [];

    /**
     * PageList constructor.
     *
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->sortDefaultField = Page::getField('created_at');
        $this->sortFields       = [
            'created_at' => Page::getField('created_at'),
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
     */
    public function render(): Factory|View|Application
    {
        return view('linky::livewire.page_list', [
            'pages' => PageRepository::paginateWithContent(10, $this->getSort())
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
