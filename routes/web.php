<?php

use Illegal\Linky\Http\Controllers\Admin\LinkAdminController;
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
});

Route::get('/{slug}', [ContentController::class, 'catchAll']);
