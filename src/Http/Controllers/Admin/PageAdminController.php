<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Http\Controllers\Controller;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;
use Illegal\Linky\Repositories\PageRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageAdminController extends Controller
{

    /**
     * List all pages.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('linky::admin.page.index');
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
     * @param Request $request The request
     * @return RedirectResponse
     */
    public function store(Request $request, PageRepository $pageRepository)
    {
        $request->validate(array_merge(Content::getValidationRules(), [
            'body' => 'required'
        ]));

        $pageRepository->create(
            $request->only(['body']),
            $request->get('public'),
            $request->get('slug'),
            $request->get('name'),
            $request->get('description')
        );

        return redirect()->route('linky.admin.page.index');
    }

    /**
     * Show form to edit an existing page.
     *
     * @param Page $page The page to show
     * @return RedirectResponse
     */
    public function show(Page $page)
    {
        return redirect(route('linky.admin.page.edit'), $page);
    }

    /**
     * Show form to edit an existing page.
     *
     * @param Page $page The page to edit
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
     * @param Request $request The request
     * @param Page $page The page to update
     * @return RedirectResponse
     */
    public function update(Request $request, PageRepository $pageRepository, Page $page)
    {
        $request->validate(array_merge(Content::getValidationRules($page->content->id), [
            'body' => 'required'
        ]));

        $pageRepository->update(
            $page,
            $request->only(['body']),
            $request->get('public'),
            $request->get('slug'),
            $request->get('name'),
            $request->get('description')
        );

        return redirect()->route('linky.admin.page.index');
    }

    /**
     * Delete an existing page.
     *
     * @param Page $page The page to delete
     * @return RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('linky.admin.page.index');
    }

}
