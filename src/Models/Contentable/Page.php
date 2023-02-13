<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Traits\Contentable;

class Page extends AbstractModel
{
    use Contentable;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'pages';

    /**
     * @var array $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'body'
    ];
}
