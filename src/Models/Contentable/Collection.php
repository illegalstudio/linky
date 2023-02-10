<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Traits\Contentable;

class Collection extends AbstractModel
{
    use Contentable;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'collections';
}
