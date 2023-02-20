<?php

namespace Illegal\Linky\Http\Controllers;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Repositories\HitRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class ContentController extends Controller
{
    /**
     * The main route, catches all the requests and handles them
     *
     * @param Request $request The request
     * @param string|null $slug The slug
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function catchAll(Request $request, string $slug = null)
    {
        $slug = $slug ?? config('linky.home_slug');

        $content = Content::where('slug', $slug)->with('contentable')->first();

        /**
         * If the content is not found, abort with a 404.
         */
        if (!$content) {
            abort(404);
        }

        HitRepository::create($request, $content);

        switch ($content->type) {
            case ContentType::Link:
                return redirect($content->contentable->url);
            case ContentType::Page:
                return new Response($content->contentable->body);
            default:
                abort(404);
        }
    }
}
