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
        'slug'        => 'nullable|string|unique:Illegal\Linky\Models\Content',
        'name'        => 'nullable|string',
        'description' => 'nullable|string'
    ];

    public static function getValidationRules(int $contentId = null): array
    {
        $validationRules = self::$validationRules;

        if ($contentId) {
            $validationRules['slug'] = 'nullable|string|unique:Illegal\Linky\Models\Content,slug,' . $contentId;
        }

        return $validationRules;
    }

    /**
     * @return MorphTo
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

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
