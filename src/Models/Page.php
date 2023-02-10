<?php

namespace Illegal\Linky\Models;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Traits\Contentable;

class Page extends AbstractModel
{
    use Contentable;

    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'pages';
}
