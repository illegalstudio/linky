<?php

namespace Illegal\Linky\Abstracts;

use Illegal\Linky\Enums\ContentStatus;
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
     * @param ContentStatus $status
     * @param string|null $slug
     * @param string|null $name
     * @param string|null $description
     * @return Content
     */
    public static function createContent(
        Model         $contentable,
        ContentType   $type,
        ContentStatus $status = ContentStatus::Draft,
        string        $slug = null,
        string        $name = null,
        string        $description = null
    ): Content
    {
        $slug = $slug ?? \Str::random();

        $content = new Content();
        $content->forceFill([
            'type'        => $type,
            'slug'        => $slug,
            'status'      => $status,
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
     * @param Content $content
     * @param ContentStatus $status
     * @param string $slug
     * @param string|null $name
     * @param string|null $description
     * @return Content
     */
    public static function updateContent(
        Content       $content,
        ContentStatus $status,
        string        $slug,
        string        $name = null,
        string        $description = null
    ): Content
    {
        $content->forceFill([
            'status'      => $status,
            'slug'        => $slug,
            'name'        => $name,
            'description' => $description,
        ]);
        $content->save();

        return $content;
    }
}
