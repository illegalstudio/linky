<?php

namespace Illegal\Linky\Traits;

use Illegal\Linky\Models\Content;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @method morphOne( string $related, string $name )
 */
trait Contentable
{
    /**
     * @return MorphOne
     */
    public function content(): MorphOne
    {
        return $this->morphOne(Content::class, 'contentable');
    }
}
