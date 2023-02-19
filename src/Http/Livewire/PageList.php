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

    protected $queryString = [];

    public function __construct($id = null)
    {
        $this->sortDefaultField = Page::getField('created_at');
        $this->sortFields       = [
            'created_at' => Page::getField('created_at'),
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
        return view('linky::livewire.page_list', [
            'pages' => PageRepository::paginateWithContent(10, $this->getSort())
        ]);
    }

    public function paginationView(): string
    {
        return 'linky::livewire._parts.paginator';
    }
}
