<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Traits\Contentable;
use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use Contentable, HasLinkyTablePrefix;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected string $tableName = 'links';

    /**
     * @var array $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'url'
    ];
}
