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
     * @param array $data The data to create the content with
     * @return Content
     */
    abstract public static function create(array $data = []): Content;

    /**
     * This function creates a new content, assigning the given contentable to it.
     *
     * @param Model $contentable The contentable
     * @param ContentType $type The content type
     * @param bool $public The content public status
     * @param string|null $slug The content slug
     * @param string|null $name The content name
     * @param string|null $description The content description
     * @return Content
     */
    public static function createContent(
        Model       $contentable,
        ContentType $type,
        bool        $public = true,
        string      $slug = null,
        string      $name = null,
        string      $description = null
    ): Content
    {
        $slug = $slug ?? \Str::random();

        $content = new Content();
        $content->forceFill([
            'type'        => $type,
            'slug'        => $slug,
            'public'      => $public,
            'name'        => $name,
            'description' => $description,
        ]);
        $content->contentable()->associate($contentable);
        $content->save();

        return $content;
    }

    /**
     * Update content, given the provided data.
     *
     * @param Content $content The content to update
     * @param bool $public The content public status
     * @param string $slug The content slug
     * @param string|null $name The content name
     * @param string|null $description The content description
     * @return Content
     */
    public static function updateContent(
        Content $content,
        bool    $public,
        string  $slug,
        string  $name = null,
        string  $description = null
    ): Content
    {
        $content->forceFill([
            'public'      => $public,
            'slug'        => $slug,
            'name'        => $name,
            'description' => $description,
        ]);
        $content->save();

        return $content;
    }
}
