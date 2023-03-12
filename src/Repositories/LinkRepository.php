<?php

namespace Illegal\Linky\Repositories;

use Exception;
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
     * @param array $data The data of the link.
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
     * @param Link $link The link to update.
     * @param array $data The data of the link.
     * @param bool $public The visibility of the content.
     * @param string $slug The slug of the content.
     * @param string|null $name The name of the content.
     * @param string|null $description The description of the content.
     * @return Content
     */
    public function update(
        Link   $link,
        array  $data,
        bool   $public,
        string $slug,
        string $name = null,
        string $description = null
    ): Content
    {
        $link->update($data);

        return $this->updateContent($link->content, $public, $slug, $name, $description);
    }


    /**
     * Paginate the links with their content.
     *
     * @param int $perPage The amount of links per page.
     * @param array $sort The sort order.
     * @return LengthAwarePaginator|array
     * @throws Exception
     */
    public function paginateWithContent(int $perPage = 10, array $sort = []): LengthAwarePaginator|array
    {
        $query = Link::with('content')
            ->select(Link::getField('*'))
            ->join(Content::getTableName(), function ($join) {
                $join
                    ->on(Content::getField('contentable_id'), '=', Link::getField('id'))
                    ->where(Content::getField('type'), '=', ContentType::Link->value);

                /**
                 * If multi-tenant is enabled, only show the links of the current user.
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
