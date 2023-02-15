<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class LinkList extends Component
{
    use WithPagination;

    public $sortField     = "";
    public $sortDirection = 'desc';

    public $sortFields = [];

    protected $queryString = [];

    public function __construct($id = null)
    {
        $this->sortField  = Link::getField('created_at');
        $this->sortFields = [
            'created_at' => Link::getField('created_at'),
            'url'        => Link::getField('url'),
            'name'       => Content::getField('name'),
            'slug'       => Content::getField('slug'),
        ];

        $this->queryString = [
            'sortField'     => ['except' => $this->sortField],
            'sortDirection' => ['except' => $this->sortDirection]
        ];

        parent::__construct($id);
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField     = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render(): Factory|View|Application
    {
        /**
         * Allow only fields that are in the $sortFields array and direction can only be asc or desc
         */
        $this->sortField     = in_array($this->sortField, $this->sortFields) ? $this->sortField : Link::getField('created_at');
        $this->sortDirection = in_array($this->sortDirection, ['asc', 'desc']) ? $this->sortDirection : 'desc';

        return view('linky::livewire.link_list', [
            'links' => Link::with('content')
                ->select(Link::getField('*'))
                ->join(Content::getTableName(), function ($join) {
                    $join
                        ->on(Content::getField('contentable_id'), '=', Link::getField('id'))
                        ->where(Content::getField('type'), '=', ContentType::Link->value);
                })->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }

    public function paginationView(): string
    {
        return 'linky::livewire._parts.paginator';
    }

}
