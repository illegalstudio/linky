<?php

use Illegal\Linky\Http\Controllers\Admin\CollectionAdminController;
use Illegal\Linky\Http\Controllers\Admin\LinkAdminController;
use Illegal\Linky\Http\Controllers\Admin\PageAdminController;
use Illegal\Linky\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */
Route::prefix('linky/admin')->middleware('web')->group(function () {
    Route::resource('links', LinkAdminController::class)->names([
        'index'   => 'linky.admin.link.index',
        'create'  => 'linky.admin.link.create',
        'store'   => 'linky.admin.link.store',
        'show'    => 'linky.admin.link.show',
        'edit'    => 'linky.admin.link.edit',
        'update'  => 'linky.admin.link.update',
        'destroy' => 'linky.admin.link.destroy',
    ]);

    Route::resource('pages', PageAdminController::class)->names([
        'index'   => 'linky.admin.page.index',
        'create'  => 'linky.admin.page.create',
        'store'   => 'linky.admin.page.store',
        'show'    => 'linky.admin.page.show',
        'edit'    => 'linky.admin.page.edit',
        'update'  => 'linky.admin.page.update',
        'destroy' => 'linky.admin.page.destroy',
    ]);

    Route::resource('collections', CollectionAdminController::class)->names([
        'index'   => 'linky.admin.collection.index',
        'create'  => 'linky.admin.collection.create',
        'store'   => 'linky.admin.collection.store',
        'show'    => 'linky.admin.collection.show',
        'edit'    => 'linky.admin.collection.edit',
        'update'  => 'linky.admin.collection.update',
        'destroy' => 'linky.admin.collection.destroy',
    ]);
});

Route::fallback([ContentController::class, 'catchAll'])->name('linky.catch-all');
