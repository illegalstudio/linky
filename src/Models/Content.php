<?php

namespace Illegal\Linky\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'contents';

    /**
     * Returns the table name with the prefix.
     *
     * @return string
     */
    public function getTable(): string
    {
        return config('linky.db.prefix') . $this->table;
    }
}
