<?php

namespace Illegal\Linky\Http\Controllers;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Repositories\HitRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

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

        HitRepository::create($request, $content);

        /**
         * If the content is not found, abort with a 404.
         */
        if (!$content || !$content->public) {
            abort(404);
        }

        switch ($content->type) {
            case ContentType::Link:
                return Redirect::to($content->contentable->url);
            case ContentType::Page:
                return Response::make($content->contentable->body);
            case ContentType::Collection:
                /** @var Collection $collection */
                $collection = $content->contentable;
                return view('linky::collection', [
                    'collection' => $collection,
                ]);
            default:
                abort(404);
        }
    }
}
