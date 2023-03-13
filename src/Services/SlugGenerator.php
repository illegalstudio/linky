<?php

namespace Illegal\Linky\Services;

use Str;

class SlugGenerator
{
    protected int $length = 5;

    public function __construct($length = 5)
    {
        $this->length = $length;
    }

    /**
     * @param string|null $string The string to generate the slug from
     * @param bool $preserveSlashes If true, it will preserve slashes
     * @return string
     */
    public function generate(string $string = null, bool $preserveSlashes = false): string
    {
        if ($string) {
            return $this->generateSlug($string, $preserveSlashes);
        } else {
            return $this->generateRandomString();
        }
    }

    /**
     * This function will generate a slug from the given string.
     * If the preserveSlashes flag is set to true, it will preserve slashes.
     *
     * @param string $string The string to generate the slug from
     * @param bool $preserveSlashes If true, it will preserve slashes
     * @return string
     */
    public function generateSlug(string $string, bool $preserveSlashes = false): string
    {
        if ($preserveSlashes) {
            return implode('/', array_map(function ($part) {
                return Str::slug($part);
            }, explode('/', $string)));
        } else {
            return Str::slug($string);
        }
    }

    /**
     * This function generates a random string. It will use the default lenght if none is given.
     *
     * @param int|null $length
     * @return string
     */
    public function generateRandomString(int $length = null): string
    {
        return Str::random($length ?? $this->length);
    }
}
