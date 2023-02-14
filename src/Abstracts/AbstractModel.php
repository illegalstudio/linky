<?php

namespace Illegal\Linky\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    protected $tableName = '';

    /**
     * Returns the table name with the prefix.
     *
     * @return string
     */
    public function getTable(): string
    {
        return config('linky.db.prefix') . $this->tableName;
    }

    /**
     * A static method to get the table name.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

    /**
     * This method returns the table name with the field name.
     *
     * @param string $field
     * @return string
     */
    public static function getField(string $field): string
    {
        return self::getTableName() . '.' . $field;
    }
}
