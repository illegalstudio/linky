<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PageRepository extends AbstractRepository
{
    /**
     * Create a new page.
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
            Page::forceCreate($data),
            ContentType::Page,
            $public,
            $slug,
            $name,
            $description
        );
    }

    public static function update(
        Page   $page,
        array  $data,
        bool   $public,
        string $slug,
        string $name = null,
        string $description = null
    ): Content
    {
        $page->update($data);

        return parent::updateContent(
            $page->content,
            $public,
            $slug,
            $name,
            $description
        );
    }

    public static function paginateWithContent($perPage = 10, array $sort = []): LengthAwarePaginator|array
    {
        $query = Page::with('content')
            ->select(Page::getField('*'))
            ->join(Content::getTableName(), function ($join) {
                $join
                    ->on(Content::getField('contentable_id'), '=', Page::getField('id'))
                    ->where(Content::getField('type'), '=', ContentType::Page->value);
            });

        if (!empty($sort)) {
            $query->orderBy(...$sort);
        }

        return $query->paginate($perPage);
    }
}
