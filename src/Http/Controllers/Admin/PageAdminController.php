<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PageAdminController extends Controller
{

    /**
     * List all pages.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pages = Page::with('content')->paginate();

        return view('linky::admin.page.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show form to create a new page.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('linky::admin.page.create');
    }

    /**
     * Save a newly created page.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('linky.admin.page.index');
    }

    /**
     * Show form to edit an existing page.
     *
     * @param Page $page
     * @return RedirectResponse
     */
    public function show(Page $page)
    {
        return redirect(route('linky.admin.page.edit'), $page);
    }

    /**
     * Show form to edit an existing page.
     *
     * @param Page $page
     * @return Application|Factory|View
     */
    public function edit(Page $page)
    {
        return view('linky::admin.page.edit', [
            'page' => $page
        ]);
    }

    /**
     * Update an existing page.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        return redirect()->route('linky.admin.page.index');
    }

    /**
     * Delete an existing page.
     *
     * @param Page $page
     * @return RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('linky.admin.page.index');
    }

}
