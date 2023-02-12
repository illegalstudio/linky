<?php

namespace Illegal\Linky\Models;

use Illegal\Linky\Abstracts\AbstractModel;
use Illegal\Linky\Enums\ContentStatus;
use Illegal\Linky\Enums\ContentType;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends AbstractModel
{
    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'contents';

    public $casts = [
        'status' => ContentStatus::class,
        'type'   => ContentType::class
    ];

    /**
     * Common validation rules for all content types.
     *
     * @var array|string[]
     */
    public static array $validationRules = [
        'status'      => 'required|in:draft,active,archived',
        'slug'        => 'nullable|string|unique:Illegal\Linky\Models\Content',
        'name'        => 'nullable|string',
        'description' => 'nullable|string'
    ];


    /**
     * @return MorphTo
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }
}
