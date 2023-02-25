<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Traits\Contentable;
use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Collection extends Model
{
    use Contentable, HasLinkyTablePrefix;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected string $tableName = 'collections';

    /**
     * Relation to contents associated with this collection.
     *
     * @return BelongsToMany
     */
    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(
            Content::class,
            config('linky.db.prefix') . 'collection_content',
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
