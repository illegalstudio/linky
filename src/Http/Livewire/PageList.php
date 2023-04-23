<?php

namespace Illegal\Linky\Http\Livewire;

use Exception;
use Illegal\Linky\Contracts\Livewire\Sortable;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;
use Illegal\Linky\Repositories\PageRepository;
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
     * @throws Exception
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
     * @param PageRepository $pageRepository
     * @return Factory|View|Application
     * @throws Exception
     */
    public function render(PageRepository $pageRepository): Factory|View|Application
    {
        return view('linky::livewire.page_list', [
            'pages' => $pageRepository->paginateWithContent(10, $this->getSort())
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
