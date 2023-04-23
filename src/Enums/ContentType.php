<?php

namespace Illegal\Linky\Enums;

use Illegal\Linky\Http\Renderers\AbortRenderer;
use Illegal\Linky\Http\Renderers\CollectionRenderer;
use Illegal\Linky\Http\Renderers\LinkRenderer;
use Illegal\Linky\Http\Renderers\PageRenderer;
use Illegal\Linky\Models\Content;
use Illuminate\Http\Request;

enum ContentType: string
{
    case Link = "link";
    case Collection = "collection";
    case Page = "page";

    /**
     * Render the content.
     * This function will return the rendered content, using the
     * appropriate renderer - based on the content type - or abort with a 404 if the content type is not supported.
     */
    public function render(Request $request, Content $content)
    {
        $renderer = match ($this) {
            self::Link       => LinkRenderer::class,
            self::Collection => CollectionRenderer::class,
            self::Page       => PageRenderer::class,
            default          => AbortRenderer::class,
        };

        return (new $renderer)->handle($request, $content);
    }
}
