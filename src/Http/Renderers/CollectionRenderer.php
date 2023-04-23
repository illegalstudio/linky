<?php

namespace Illegal\Linky\Http\Renderers;

use Illegal\Linky\Contracts\AbstractRenderer;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as IlluminateResponse;

class CollectionRenderer extends AbstractRenderer
{

    public function handle(Request $request, Content $content): IlluminateResponse
    {
        /** @var Collection $collection */
        $collection = $content->contentable;
        return Response::make(view('linky::public.collection.default', [
            'collection' => $collection,
        ]));
    }
}
