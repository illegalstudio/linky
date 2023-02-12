<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentStatus;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;

final class PageRepository extends AbstractRepository
{
    /**
     * Create a new page.
     *
     * @param array $data
     * @param ContentStatus $status
     * @param string|null $slug
     * @param string|null $name
     * @param string|null $description
     * @return Content
     */
    public static function create(
        array         $data = [],
        ContentStatus $status = ContentStatus::Draft,
        string        $slug = null,
        string        $name = null,
        string        $description = null
    ): Content
    {
        return parent::createContent(
            Page::forceCreate($data),
            ContentType::Page,
            $status,
            $slug,
            $name,
            $description
        );
    }
}
