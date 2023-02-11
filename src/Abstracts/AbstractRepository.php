<?php

namespace Illegal\Linky\Abstracts;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * This function must be implemented by the child class.
     *
     * @param array $data
     * @return Content
     */
    abstract public static function create(array $data = []): Content;

    /**
     * This function creates a new content, assigning the given contentable to it.
     *
     * @param Model $contentable
     * @param ContentType $type
     * @param string|null $slug
     * @return Content
     */
    public static function createContent(Model $contentable, ContentType $type, string $slug = null): Content
    {
        $slug = $slug ?? \Str::random();

        $content = new Content();
        $content->forceFill([
            'type' => $type,
            'slug' => $slug,
        ]);
        $content->contentable()->associate($contentable);
        $content->save();

        return $content;
    }
}
