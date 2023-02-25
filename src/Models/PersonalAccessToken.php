<?php

namespace Illegal\Linky\Models;

use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasLinkyTablePrefix;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected $tableName = 'personal_access_tokens';

}
