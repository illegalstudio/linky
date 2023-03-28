<?php

namespace Illegal\Linky\Models\Statistics;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    use HasPrefix;

    /**
     * Override the db prefix for this model.
     */
    public function getPrefix(): string
    {
        return config('linky.db.prefix');
    }

    /**
     * @var string[] $casts The casts of the model.
     */
    protected $casts = [
        'headers' => 'array',
        'get'     => 'array',
        'post'    => 'array',
    ];
}
