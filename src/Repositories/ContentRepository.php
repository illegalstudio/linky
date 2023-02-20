<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ContentRepository
{
    public static function search(string $searchString, array|int $excludeCollectionsIds = null, int $limit = 10): EloquentCollection
    {
        if (empty($searchString)) {
            $query = Content::orderBy('created_at', 'DESC');
        } else {
            $query = Content::where(function ($query) use ($searchString) {
                $query->where('name', 'LIKE', '%' . $searchString . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchString . '%');
            })->orderBy('created_at', 'DESC');
        }

        if ($excludeCollectionsIds) {
            $excludeCollectionsIds = is_array($excludeCollectionsIds) ? $excludeCollectionsIds : [$excludeCollectionsIds];

            $query->whereDoesntHave('collections', function ($query) use ($excludeCollectionsIds) {
                $query
                    ->whereIn(config('linky.db.prefix') . 'collections.id', $excludeCollectionsIds);
            });
        }

        return $query->limit($limit)->get();
    }
}
