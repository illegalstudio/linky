<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Models\Contentable\Link;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class CollectionRepository extends AbstractRepository
{
    /**
     * Create a new collection.
     *
     * @param array $data
     * @param boolean $public
     * @param string|null $slug
     * @param string|null $name
     * @param string|null $description
     * @return Content
     */
    public static function create(
        array  $data = [],
        bool   $public = true,
        string $slug = null,
        string $name = null,
        string $description = null
    ): Content
    {
        return parent::createContent(
            Collection::forceCreate($data),
            ContentType::Collection,
            $public,
            $slug,
            $name,
            $description
        );
    }

    public static function update(
        Collection $collection,
        array      $data,
        bool       $public,
        string     $slug,
        string     $name = null,
        string     $description = null
    ): Content
    {
        $collection->update($data);

        return parent::updateContent(
            $collection->content,
            $public,
            $slug,
            $name,
            $description
        );
    }

    public static function paginateWithContent($perPage = 10, array $sort = []): LengthAwarePaginator|array
    {
        $query = Collection::with('content')
            ->select(Collection::getField('*'))
            ->join(Content::getTableName(), function ($join) {
                $join
                    ->on(Content::getField('contentable_id'), '=', Collection::getField('id'))
                    ->where(Content::getField('type'), '=', ContentType::Collection->value);
            });

        if (!empty($sort)) {
            $query->orderBy(...$sort);
        }

        return $query->paginate($perPage);
    }
}
