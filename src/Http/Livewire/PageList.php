<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PageList extends Component
{
    use WithPagination;

    public function render(): Factory|View|Application
    {
        return view('linky::livewire.page_list', [
            'pages' => Page::with('content')->paginate(10)
        ]);
    }

    public function paginationView(): string
    {
        return 'linky::livewire._parts.paginator';
    }
}
