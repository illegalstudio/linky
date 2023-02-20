<?php

namespace Illegal\Linky\Repositories;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Statistics\Hit;
use Illuminate\Http\Request;

class HitRepository
{
    /**
     * Create a new hit.
     *
     * @param Request $request The request, used to get the extra user information
     * @param Content $content The content to create the hit for
     * @return Hit
     */
    public static function create(Request $request, Content $content): Hit
    {
        return Hit::forceCreate(
            [
                'content_id' => $content->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer'    => $request->header('referer'),
            ]
        );
    }
}
