<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Traits\Contentable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Collection extends AbstractModel
{
    use Contentable;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'collections';

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
        );
    }

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
