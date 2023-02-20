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
                'url'        => $request->fullUrl(),
                'scheme'     => $request->getScheme(),
                'host'       => $request->getHost(),
                'path'       => $request->path(),
                'method'     => $request->method(),
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'referer'    => $request->header('referer'),
                // ...
                'headers'    => $request->headers->all(),
                'get'        => $request->query->all(),
                'post'       => $request->request->all(),
            ]
        );
    }
}
