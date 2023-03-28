<?php

namespace Illegal\Linky\Models;

use Illegal\InsideAuth\Models\User;
use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Models\Statistics\Hit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model
{
    use HasPrefix;

    /**
     * Override the db prefix for this model.
     */
    public function getPrefix(): string
    {
        return config('linky.db.prefix');
    }

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

    protected static function boot()
    {
        static::deleting(function ($content) {
            /**
             * Detaching from all collections.
             */
            $content->collections()->detach();

            /**
             * Deleting related models
             * Using queries so that no events are fired.
             */
            $content->hits()->delete();
            $content->contentable()->delete();
        });

        parent::boot();
    }

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

    /**
     * Relation to the hits associated with this content.
     *
     * @return HasMany
     */
    public function hits(): HasMany
    {
        return $this->hasMany(Hit::class);
    }

    /**
     * Relation to the user that created the content.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
