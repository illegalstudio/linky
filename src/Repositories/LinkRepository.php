<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;

final class LinkRepository extends AbstractRepository
{
    /**
     * Create a new redirect.
     *
     * @param array $data
     * @return Content
     */
    public static function create(array $data = []): Content
    {
        return parent::createContent(
            Link::forceCreate($data),
            ContentType::Redirect
        );
    }
}
