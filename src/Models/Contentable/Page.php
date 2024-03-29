<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illegal\Linky\Contracts\Contentable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Contentable, HasPrefix;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "linky_pages";

    /**
     * Override the db prefix for this model.
     */
    public function getPrefix(): string
    {
        return config('linky.db.prefix');
    }

    /**
     * @var array $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'body'
    ];
}
