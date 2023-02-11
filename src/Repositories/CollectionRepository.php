<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Abstracts\AbstractRepository;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;

final class CollectionRepository extends AbstractRepository
{
    /**
     * Create a new collection.
     *
     * @param array $data
     * @return Content
     */
    public static function create(array $data = []): Content
    {
        return parent::createContent(
            Collection::forceCreate($data),
            ContentType::Collection
        );
    }
}
