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
    /**
     * @var ContentRepository
     */
    protected ContentRepository $contentRepository;

    /**
     * @var Collection $collection The collection to manage
     */
    public Collection $collection;

    /**
     * @var string $searchAvailableContentsString The string to search for available contents
     */
    public string $searchAvailableContentsString = '';

    /**
     * @var string $filterCurrentContentsString The string to filter the current contents
     */
    public string $filterCurrentContentsString = '';

    /**
     * @var EloquentCollection $availableContents The available contents
     */
    public EloquentCollection $availableContents;

    /**
     * @var EloquentCollection $currentContents The current contents
     */
    public EloquentCollection $currentContents;

    /**
     * Mount the component.
     *
     * @param Collection $collection
     * @return void
     */
    public function mount(Collection $collection): void
    {
        $this->collection = $collection;

        $this->searchAvailableContentsAction();
        $this->filterCurrentContentsAction();
    }

    /**
     * Boot the component.
     *
     * @param ContentRepository $contentRepository
     * @return void
     */
    public function boot(ContentRepository $contentRepository): void
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * Render the component.
     *
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('linky::livewire.collection_content_manager');
    }

    /**
     * Search for available contents.
     *
     * @return void
     */
    public function searchAvailableContentsAction(): void
    {
        $this->availableContents = $this->contentRepository->search($this->searchAvailableContentsString, $this->collection);
    }

    /**
     * Filter the current contents.
     *
     * @return void
     */
    public function filterCurrentContentsAction(): void
    {
        $this->currentContents = $this->collection->filterContents($this->filterCurrentContentsString);
    }

    /**
     * Add a content to the collection.
     *
     * @param Content $content The content to add
     * @return void
     */
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

    /**
     * Remove a content from the collection.
     *
     * @param Content $content The content to remove
     * @return void
     */
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
