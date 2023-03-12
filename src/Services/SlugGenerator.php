<?php

namespace Illegal\Linky\Services;

use Str;

class SlugGenerator
{
    protected int $length = 5;

    public function __construct()
    {
        $this->length = 5;
    }

    public function generate($string = null, $preserveSlashes = false): string
    {
        if($string) {
            return $this->generateSlug($string, $preserveSlashes);
        } else {
            return $this->generateRandomString();
        }
    }

    public function generateSlug($string, $preserveSlashes = false): string
    {
        if($preserveSlashes) {
            return implode('/', array_map(function($part) {
                return Str::slug($part);
            }, explode('/', $string)));
        } else {
            return Str::slug($string);
        }
    }

    public function generateRandomString(): string
    {
        return Str::random($this->length);
    }
}
