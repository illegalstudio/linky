<?php

namespace Illegal\Linky\Repositories;

use Exception;
use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PageRepository extends AbstractRepository
{
    /**
     * Create a new page.
     *
     * @param array $data The data of the page.
     * @param bool $public The visibility of the content.
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
        return $this->createContent(
            Page::forceCreate($data),
            ContentType::Page,
            $public,
            $slug,
            $name,
            $description
        );
    }

    /**
     * Update the page and content.
     *
     * @param Page $page The page to update.
     * @param array $data The data of the page.
     * @param bool $public The visibility of the content.
     * @param string $slug The slug of the content.
     * @param string|null $name The name of the content.
     * @param string|null $description The description of the content.
     * @return Content
     */
    public function update(
        Page   $page,
        array  $data,
        bool   $public,
        string $slug,
        string $name = null,
        string $description = null
    ): Content
    {
        $page->update($data);

        return $this->updateContent(
            $page->content,
            $public,
            $slug,
            $name,
            $description
        );
    }

    /**
     * Paginate all pages with their content.
     *
     * @param int $perPage The number of items per page.
     * @param array $sort The sort order.
     * @return LengthAwarePaginator|array
     * @throws Exception
     */
    public function paginateWithContent(int $perPage = 10, array $sort = []): LengthAwarePaginator|array
    {
        $query = Page::with('content')
            ->select(Page::getField('*'))
            ->join(Content::getTableName(), function ($join) {
                $join
                    ->on(Content::getField('contentable_id'), '=', Page::getField('id'))
                    ->where(Content::getField('type'), '=', ContentType::Page->value);

                /**
                 * If multi-tenant is enabled, only show the pages of the current user.
                 */
                if(config('linky.auth.multi_tenant')) {
                    $join->where(Content::getField('user_id'), '=', auth()->id());
                }
            });

        if (!empty($sort)) {
            $query->orderBy(...$sort);
        }

        return $query->paginate($perPage);
    }
}
