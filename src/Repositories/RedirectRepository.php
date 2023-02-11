<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Redirect;

final class RedirectRepository extends AbstractRepository
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
            Redirect::forceCreate($data),
            ContentType::Redirect
        );
    }
}
