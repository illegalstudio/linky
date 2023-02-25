<?php

namespace Illegal\Linky\Models;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends AbstractModel
{
    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'contents';

    public $casts = [
        'type' => ContentType::class
    ];

    /**
     * Common validation rules for all content types.
     *
     * @var array|string[]
     */
    protected static array $validationRules = [
        'public'      => 'required|boolean',
        'slug'        => 'nullable|max:255|string|unique:Illegal\Linky\Models\Content',
        'name'        => 'nullable|max:255|string',
        'description' => 'nullable|string'
    ];

    /**
     * Get the common validation rules for the content.
     *
     * @param int|null $contentId The content id
     * @return array
     */
    public static function getValidationRules(int $contentId = null): array
    {
        $validationRules = self::$validationRules;

        if ($contentId) {
            $validationRules['slug'] = 'nullable|string|unique:Illegal\Linky\Models\Content,slug,' . $contentId;
        }

        return $validationRules;
    }

    /**
     * Relation to the contentable model.
     *
     * @return MorphTo
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation to the collections associated with this content.
     *
     * @return BelongsToMany
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(
            Collection::class,
            config('linky.db.prefix') . 'collection_content',
            'content_id',
            'collection_id'
        )->withPivot('position');
    }
}
