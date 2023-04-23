<?php

namespace Illegal\Linky\Http\Renderers;

use Illegal\Linky\Contracts\AbstractRenderer;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Response;

class PageRenderer extends AbstractRenderer
{

    public function handle(Request $request, Content $content): IlluminateResponse
    {
        /** @var Page $page */
        $page = $content->contentable;
        return Response::make($page->body);
    }
}
