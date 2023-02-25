<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\Linky\Traits\Contentable;
use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Contentable, HasLinkyTablePrefix;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected string $tableName = 'pages';

    /**
     * @var array $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'body'
    ];
}
