<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Repositories\ContentRepository;
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
        $this->availableContents = ContentRepository::search($this->searchAvailableContentsString);
        $this->currentContents   = Content::all();

        parent::__construct($id);
    }

    public function render(): Factory|View|Application
    {
        return view('linky::livewire.collection_content_manager');
    }

    public function searchAvailableContentsAction(): void
    {
        $this->availableContents = ContentRepository::search($this->searchAvailableContentsString);
    }

    public function filterCurrentContentsAction(): void
    {
    }
}
