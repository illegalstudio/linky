<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illegal\Linky\Contracts\Contentable;
use Illegal\Linky\Models\Content;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collection extends Model
{
    use Contentable, HasPrefix;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "linky_collections";

    /**
     * Override the db prefix for this model.
     */
    public function getPrefix(): string
    {
        return config('linky.db.prefix');
    }

    /**
     * Returns the table name for the collection_contents table.
     */
    private function collectionContentsTable(): string
    {
        return $this->getPrefix() . 'collection_contents';
    }

    /**
     * Returns the table name for the collection_contents table.
     * Static version of the above method.
     */
    public static function getCollectionContentsTable(): string
    {
        return ( new self() )->collectionContentsTable();
    }

    protected static function boot()
    {
        self::deleting(function ($collection) {
            /**
             * Detaching all contents
             */
            $collection->contents()->detach();
        });

        parent::boot();
    }

    /**
     * Relation to contents associated with this collection.
     *
     * @return BelongsToMany
     */
    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(
            Content::class,
            $this->collectionContentsTable(),
            'collection_id',
            'content_id'
        )->withPivot('position')->orderBy('position');
    }

    /**
     * Get the contents associated with this collection.
     *
     * @param string $filterString The string to filter the contents
     * @return EloquentCollection
     */
    public function filterContents(string $filterString): EloquentCollection
    {
        if (empty($filterString)) {
            return $this->contents()->orderBy('created_at', 'desc')->get();
        }

        return $this->contents()
            ->where('name', 'like', '%' . $filterString . '%')
            ->orWhere('slug', 'like', '%' . $filterString . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
