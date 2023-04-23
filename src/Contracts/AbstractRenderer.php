<?php

namespace Illegal\Linky\Contracts;

use Illegal\Linky\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

/**
 * This is the abstract renderer class.
 * It should be extended by all renderers.
 * A renderer is responsible for rendering a specific content type.
 */
abstract class AbstractRenderer
{
    abstract public function handle(Request $request, Content $content): RedirectResponse|Response;
}
