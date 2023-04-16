<?php

namespace Illegal\Linky\Repositories;

use Exception;
use Illegal\Linky\Contracts\AbstractContentableRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class CollectionRepository extends AbstractContentableRepository
{
    /**
     * Create a new collection.
     *
     * @param array $data The data of the collection.
     * @param boolean $public The visibility of the content.
     * @param string|null $slug The slug of the content.
     * @param string|null $name The name of the content.
     * @param string|null $description The description of the content.
     * @return Content
     */
    public function create(
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

    /**
     * Update an existing collection.
     *
     * @param Collection $collection The collection to update.
     * @param array $data The data of the collection.
     * @param boolean $public The visibility of the content.
     * @param string $slug The slug of the content.
     * @param string|null $name The name of the content.
     * @param string|null $description The description of the content.
     * @return Content
     */
    public function update(
        Collection $collection,
        array      $data,
        bool       $public,
        string     $slug,
        string     $name = null,
        string     $description = null
    ): Content
    {
        $collection->update($data);

        return $this->updateContent(
            $collection->content,
            $public,
            $slug,
            $name,
            $description
        );
    }

    /**
     * Paginate the collections with their content.
     *
     * @param $perPage int The amount of items per page.
     * @param array $sort The sort order.
     * @return LengthAwarePaginator|array
     * @throws Exception
     */
    public function paginateWithContent(int $perPage = 10, array $sort = []): LengthAwarePaginator|array
    {
        $query = Collection::with('content')
            ->select(Collection::getField('*'))
            ->join(Content::getTableName(), function ($join) {
                $join
                    ->on(Content::getField('contentable_id'), '=', Collection::getField('id'))
                    ->where(Content::getField('type'), '=', ContentType::Collection->value);

                /**
                 * If multi-tenant is enabled, only show the collections of the current user.
                 */
                if (config('linky.auth.multi_tenant')) {
                    $join->where(Content::getField('user_id'), '=', auth()->id());
                }
            });

        if (!empty($sort)) {
            $query->orderBy(...$sort);
        }

        return $query->paginate($perPage);
    }
}
