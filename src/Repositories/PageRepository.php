<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;

final class PageRepository extends AbstractRepository
{
    /**
     * Create a new page.
     *
     * @param array $data
     * @return Content
     */
    public static function create(array $data = []): Content
    {
        return parent::createContent(
            Page::forceCreate($data),
            ContentType::Page
        );
    }
}
