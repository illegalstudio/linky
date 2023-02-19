<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class LinkRepository extends AbstractRepository
{
    /**
     * Create a new redirect.
     *
     * @param array $data
     * @param bool $public
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
            Link::create($data),
            ContentType::Link,
            $public,
            $slug,
            $name,
            $description
        );
    }

    /**
     * Update the link and content.
     *
     * @param Link $link
     * @param array $data
     * @param bool $public
     * @param string $slug
     * @param string|null $name
     * @param string|null $description
     * @return Content
     */
    public static function update(
        Link   $link,
        array  $data,
        bool   $public,
        string $slug,
        string $name = null,
        string $description = null
    ): Content
    {
        $link->update($data);

        return parent::updateContent($link->content, $public, $slug, $name, $description);
    }


    public static function paginateWithContent($perPage = 10, array $sort = []): LengthAwarePaginator|array
    {
        $query = Link::with('content')
            ->select(Link::getField('*'))
            ->join(Content::getTableName(), function ($join) {
                $join
                    ->on(Content::getField('contentable_id'), '=', Link::getField('id'))
                    ->where(Content::getField('type'), '=', ContentType::Link->value);
            });

        if (!empty($sort)) {
            $query->orderBy(...$sort);
        }

        return $query->paginate($perPage);
    }
}
