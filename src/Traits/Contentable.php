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
     * Boot the Contentable model.
     *
     * @return void
     */
    public static function bootContentable(): void
    {
        /**
         * Delete the content when the model is deleted.
         */
        static::deleting(function ($model) {
            $model->content()->delete();
        });
    }

    /**
     * @return MorphOne
     */
    public function content(): MorphOne
    {
        return $this->morphOne(Content::class, 'contentable');
    }
}
