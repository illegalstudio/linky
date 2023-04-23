<?php

namespace Illegal\Linky\Models\Statistics;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    use HasPrefix;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "linky_hits";

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
