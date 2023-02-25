<?php

namespace Illegal\Linky\Models\Statistics;

use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    use HasLinkyTablePrefix;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected string $tableName = "hits";

    /**
     * @var string[] $casts The casts of the model.
     */
    protected $casts = [
        'headers' => 'array',
        'get'     => 'array',
        'post'    => 'array',
    ];
}
