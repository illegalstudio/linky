<?php

namespace Illegal\Linky\Models\Statistics;

use Illegal\Linky\Abstracts\AbstractModel;

class Hit extends AbstractModel
{
    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = "hits";

    /**
     * @var string[] $casts The casts of the model.
     */
    protected $casts = [
        'headers' => 'array',
        'get'     => 'array',
        'post'    => 'array',
    ];
}
