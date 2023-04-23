<?php

namespace Illegal\Linky\Http\Renderers;

use Illegal\Linky\Contracts\AbstractRenderer;
use Illegal\Linky\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * This is the abort renderer class.
 * It is responsible for rendering a 404 page if the
 * content type is not supported.
 */
class AbortRenderer extends AbstractRenderer
{

    public function handle(Request $request, Content $content): Response|RedirectResponse
    {
        abort(404);
    }
}
