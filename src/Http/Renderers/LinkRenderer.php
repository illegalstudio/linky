<?php

namespace Illegal\Linky\Http\Renderers;

use Illegal\Linky\Contracts\AbstractRenderer;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkRenderer extends AbstractRenderer
{

    public function handle(Request $request, Content $content): RedirectResponse
    {
        /** @var Link $link */
        $link = $content->contentable;
        return Redirect::to($link->url);
    }
}
