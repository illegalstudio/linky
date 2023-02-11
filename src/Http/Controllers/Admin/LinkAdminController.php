<?php

namespace Illegal\Linky\Http\Controllers\Admin;

use Illegal\Linky\Models\Contentable\Link;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LinkAdminController extends Controller
{
    public function index(Request $request)
    {
        $links = Link::paginate();

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
        return redirect()->route('linky.admin.link.index');
    }

    public function show(Request $request, $id)
    {
        return view('linky::admin.link.show');
    }

    public function edit(Request $request, $id)
    {
        return view('linky::admin.link.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('linky.admin.link.index');
    }

    public function destroy(Request $request, $id)
    {
        return redirect()->route('linky.admin.link.index');
    }
}
