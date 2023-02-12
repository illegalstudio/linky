<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Enums\ContentStatus;
use Illegal\Linky\Models\Contentable\Link;
use Illegal\Linky\Repositories\LinkRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class LinkAdminController extends Controller
{
    public function index(Request $request)
    {
        $links = Link::with('content')->paginate();

        return view('linky::admin.link.index',  [
            'links' => $links
        ]);
    }

    public function create(Request $request)
    {
        return view('linky::admin.link.create');
    }

    public function store(Request $request)
    {
        LinkRepository::create(
            $request->except(['_token', '_method', 'name', 'status', 'slug', 'description']),
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

    public function edit(Request $request, Link $link)
    {
        return view('linky::admin.link.edit', [
            'link' => $link
        ]);
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('linky.admin.link.index');
    }

    public function destroy(Request $request, Link $link)
    {
        $link->delete();
        return redirect()->route('linky.admin.link.index');
    }
}
