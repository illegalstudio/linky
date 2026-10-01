<?php

namespace Illegal\Linky\Contracts;

use Illuminate\Support\Str;

trait HasPrefix
{
    /**
     * The table name will be cached here the first time is called.
     * Subsequent calls will return the cached value.
     */
    protected ?string $tableNameCache = null;

    /**
     * Returns the prefix, override this function if you need
     * a programmatic way of setting the prefix.
     *
     * If you need a "static" prefix, you can set it in your model via the $prefix property.
     */
    protected function getPrefix(): string
    {
        return $this->prefix ?? '';
    }

    /**
     * Returns the table name with the prefix.
     * Overrides the default getTable() method.
     */
    public function getTable(): string
    {
        if (filled($this->tableNameCache)) {
            return $this->tableNameCache;
        }

        return $this->tableNameCache = $this->getPrefix().Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /**
     * A static method to get the table name.
     */
    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

    /**
     * This method returns the table name with the field name.
     */
    public static function getField(string $field): string
    {
        return self::getTableName().'.'.$field;
    }
}
