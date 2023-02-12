<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Enums\ContentStatus;
use Illegal\Linky\Models\Contentable\Link;
use Illegal\Linky\Repositories\LinkRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class LinkAdminController extends Controller
{
    /**
     * List all links.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $links = Link::with('content')->paginate();

        return view('linky::admin.link.index', [
            'links' => $links
        ]);
    }

    /**
     * Show form to create a new link.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        return view('linky::admin.link.create');
    }

    /**
     * Save a newly created link.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        LinkRepository::create(
            $request->only(['url']),
            ContentStatus::from($request->get('status')),
            $request->get('slug'),
            $request->get('name'),
            $request->get('description')
        );

        return redirect()->route('linky.admin.link.index');
    }

    /**
     * Not implemented, redirect to edit.
     *
     * @param Request $request
     * @param Link $link
     * @return Application|RedirectResponse|Redirector
     */
    public function show(Request $request, Link $link)
    {
        return redirect(route('linky.admin.link.edit', $link));
    }

    /**
     * Show form to edit a link.
     *
     * @param Request $request
     * @param Link $link
     * @return Application|Factory|View
     */
    public function edit(Request $request, Link $link)
    {
        return view('linky::admin.link.edit', [
            'link' => $link
        ]);
    }

    /**
     * Update a link.
     *
     * @param Request $request
     * @param Link $link
     * @return RedirectResponse
     */
    public function update(Request $request, Link $link)
    {
        LinkRepository::update(
            $link,
            $request->only(['url']),
            ContentStatus::from($request->get('status')),
            $request->get('slug'),
            $request->get('name'),
            $request->get('description')
        );

        return redirect()->route('linky.admin.link.index');
    }

    /**
     * Delete a link.
     *
     * @param Request $request
     * @param Link $link
     * @return RedirectResponse
     */
    public function destroy(Request $request, Link $link)
    {
        $link->delete();
        return redirect()->route('linky.admin.link.index');
    }
}
