<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ContentRepository
{
    /**
     * Search within all contents.
     *
     * @param string $searchString The string to search for
     * @param array|Collection|null $excludeCollections The collections to exclude
     * @param int $limit The limit of results
     * @return EloquentCollection
     */
    public function search(string $searchString, array|Collection $excludeCollections = null, int $limit = 10): EloquentCollection
    {
        if (empty($searchString)) {
            $query = Content::orderBy('created_at', 'DESC');
        } else {
            $query = Content::where(function ($query) use ($searchString) {
                $query->where('name', 'LIKE', '%' . $searchString . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchString . '%');
            })->orderBy('created_at', 'DESC');
        }

        /**
         * If multi tenant is enabled, only show the contents of the current user.
         */
        if (config('linky.auth.multi_tenant')) {
            $query->where('user_id', '=', auth()->id());
        }

        if ($excludeCollections) {
            $excludeCollections = is_array($excludeCollections) ? $excludeCollections : [$excludeCollections];

            /**
             * Get the collection ids.
             */
            $excludeCollectionsIds = array_map(function ($collection) {
                return is_object($collection) ? $collection->id : $collection;
            }, $excludeCollections);

            $query->whereDoesntHave('collections', function ($query) use ($excludeCollectionsIds) {
                $query
                    ->whereIn(config('linky.db.prefix') . 'collections.id', $excludeCollectionsIds);
            });
        }

        return $query->limit($limit)->get();
    }
}
