<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Models\Content;
use Illuminate\Database\Eloquent\Collection;

class ContentRepository
{
    public static function search(string $searchString): Collection
    {
        return Content::where('name', 'LIKE', '%' . $searchString . '%')
            ->orWhere('slug', 'LIKE', '%' . $searchString . '%')
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
    }
}
