<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CollectionAdminController extends Controller
{
    /**
     * List all collections.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $collections = Collection::with('content')->paginate();

        return view('linky::admin.collection.index', [
            'collections' => $collections
        ]);
    }

    /**
     * Show form to create a new collection.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('linky::admin.collection.create');
    }

    /**
     * Save a newly created collection.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('linky.admin.collection.index');
    }

    /**
     * Show form to edit an existing collection.
     *
     * @param Collection $collection
     * @return RedirectResponse
     */
    public function show(Collection $collection)
    {
        return redirect(route('linky.admin.collection.edit'));
    }

    /**
     * Show form to edit an existing collection.
     *
     * @param Collection $collection
     * @return Application|Factory|View
     */
    public function edit(Collection $collection)
    {
        return view('linky::admin.collection.edit');
    }

    /**
     * Update an existing collection.
     *
     * @param Collection $collection
     * @return RedirectResponse
     */
    public function update(Collection $collection)
    {
        return redirect()->route('linky.admin.collection.index');
    }


    /**
     * Delete an existing collection.
     *
     * @param Collection $collection
     * @return RedirectResponse
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()->route('linky.admin.collection.index');
    }
}
