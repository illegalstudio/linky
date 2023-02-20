<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;
use Illegal\Linky\Repositories\LinkRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LinkAdminController extends Controller
{
    /**
     * List all links.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('linky::admin.link.index');
    }

    /**
     * Show form to create a new link.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('linky::admin.link.create');
    }

    /**
     * Save a newly created link.
     *
     * @param Request $request The request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(array_merge(Content::getValidationRules(), [
            'url' => 'required|url'
        ]));

        LinkRepository::create(
            $request->only(['url']),
            $request->get('public'),
            $request->get('slug'),
            $request->get('name'),
            $request->get('description')
        );

        return redirect()->route('linky.admin.link.index');
    }

    /**
     * Not implemented, redirect to edit.
     *
     * @param Link $link The link to show
     * @return RedirectResponse
     */
    public function show(Link $link)
    {
        return redirect(route('linky.admin.link.edit', $link));
    }

    /**
     * Show form to edit a link.
     *
     * @param Link $link The link to edit
     * @return Application|Factory|View
     */
    public function edit(Link $link)
    {
        return view('linky::admin.link.edit', [
            'link' => $link
        ]);
    }

    /**
     * Update a link.
     *
     * @param Request $request The request
     * @param Link $link The link to update
     * @return RedirectResponse
     */
    public function update(Request $request, Link $link)
    {
        $request->validate(array_merge(Content::getValidationRules($link->content->id), [
            'url' => 'required|url'
        ]));

        LinkRepository::update(
            $link,
            $request->only(['url']),
            $request->get('public'),
            $request->get('slug'),
            $request->get('name'),
            $request->get('description')
        );

        return redirect()->route('linky.admin.link.index');
    }

    /**
     * Delete a link.
     *
     * @param Link $link The link to delete
     * @return RedirectResponse
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('linky.admin.link.index');
    }
}
