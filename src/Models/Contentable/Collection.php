<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Traits\Contentable;

class Collection extends AbstractModel
{
    use Contentable;

    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'collections';
}
