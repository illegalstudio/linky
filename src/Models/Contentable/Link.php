<?php

namespace Illegal\Linky\Models\Contentable;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illegal\Linky\Traits\Contentable;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use Contentable, HasPrefix;

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
        'url'
    ];
}
