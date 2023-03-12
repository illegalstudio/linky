<?php

namespace Illegal\Linky\Abstracts;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Auth\User;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Services\SlugGenerator;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * @param SlugGenerator $slugGenerator The slug generator service
     */
    public function __construct(private readonly SlugGenerator $slugGenerator)
    {}

    /**
     * This function must be implemented by the child class.
     *
     * @param array $data The data to create the content with
     * @return Content
     */
    abstract public function create(array $data = []): Content;

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
    public function createContent(
        Model       $contentable,
        ContentType $type,
        bool        $public = true,
        string      $slug = null,
        string      $name = null,
        string      $description = null
    ): Content
    {

        $content = new Content();
        $content->forceFill([
            'slug'        => $this->slugGenerator->generate($slug),
            'type'        => $type,
            'public'      => $public,
            'name'        => $name,
            'description' => $description,
        ]);
        $content->contentable()->associate($contentable);

        /**
         * If the system is configured to use linky auth and
         * the user is logged in, associate the content with the user.
         */
        if (config('linky.auth.use_linky_auth') && auth()->user() && auth()->user() instanceof User) {
            $content->user()->associate(auth()->user());
        }

        /**
         * Save and return the content.
         */
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
    public function updateContent(
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

        /**
         * Save and return the content.
         */
        $content->save();
        return $content;
    }
}
