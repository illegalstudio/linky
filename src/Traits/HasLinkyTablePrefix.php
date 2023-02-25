<?php

namespace Illegal\Linky\Traits;

use Exception;

trait HasLinkyTablePrefix
{
    /**
     * Returns the table name with the prefix.
     *
     * @return string
     * @throws Exception
     */
    public function getTable(): string
    {
        if(empty($this->tableName)) {
            throw new Exception('The table name is not set.');
        }

        return config('linky.db.prefix') . $this->tableName;
    }

    /**
     * A static method to get the table name.
     *
     * @return string
     * @throws Exception
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
     * @throws Exception
     */
    public static function getField(string $field): string
    {
        return self::getTableName() . '.' . $field;
    }

}
