<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Content;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CollectionContentManager extends Component
{

    public string $searchAvailableContentsString = '';

    public string $filterCurrentContentsString = '';

    public Collection $availableContents;

    public Collection $currentContents;

    public function __construct($id = null)
    {
        $this->availableContents = Content::all();
        $this->currentContents   = Content::all();

        parent::__construct($id);
    }

    public function render(): Factory|View|Application
    {
        return view('linky::livewire.collection_content_manager');
    }

    public function searchAvailableContentsAction(): void
    {
    }

    public function filterCurrentContentsAction(): void
    {
    }
}
