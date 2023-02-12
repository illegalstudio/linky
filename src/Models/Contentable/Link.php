<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Traits\Contentable;

class Link extends AbstractModel
{
    use Contentable;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'links';

    /**
     * @var array $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'url'
    ];
}
