<?php

namespace Illegal\Linky\Http\Livewire;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Repositories\ContentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;

class CollectionContentManager extends Component
{
    public Collection $collection;

    public string $searchAvailableContentsString = '';

    public string $filterCurrentContentsString = '';

    public EloquentCollection $availableContents;

    public EloquentCollection $currentContents;

    public function mount(Collection $collection): void
    {
        $this->collection = $collection;
        $this->searchAvailableContentsAction();
        $this->filterCurrentContentsAction();
    }

    public function render(): Factory|View|Application
    {
        return view('linky::livewire.collection_content_manager');
    }

    public function searchAvailableContentsAction(): void
    {
        $this->availableContents = ContentRepository::search($this->searchAvailableContentsString, $this->collection->id);
    }

    public function filterCurrentContentsAction(): void
    {
        $this->currentContents = $this->collection->filterContents($this->filterCurrentContentsString);
    }

    public function addContentAction(Content $content): void
    {
        /**
         * Attach the new content
         */
        $this->collection->contents()->attach($content, [
            'position' => $this->collection->contents()->with('pivot')->max('position') + 1,
        ]);
        /**
         * Reset the view
         */
        $this->filterCurrentContentsString = '';
        $this->searchAvailableContentsAction();
        $this->filterCurrentContentsAction();
    }

    public function removeContentAction(Content $content): void
    {
        /**
         * Detach the content and reorder
         */
        $this->collection->contents()->detach($content);
        $this->collection->contents()->get()->each(function (Content $content, int $index) {
            $content->pivot->position = $index + 1;
            $content->pivot->save();
        });
        /**
         * Reset the view
         */
        $this->filterCurrentContentsString = '';
        $this->searchAvailableContentsAction();
        $this->filterCurrentContentsAction();
    }
}
