<?php

use Illegal\Linky\Http\Controllers\Admin\CollectionAdminController;
use Illegal\Linky\Http\Controllers\Admin\LinkAdminController;
use Illegal\Linky\Http\Controllers\Admin\PageAdminController;
use Illegal\Linky\Http\Controllers\ContentController;
use Illegal\Linky\LinkyAuth;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

$admin = Route::prefix('linky/admin');

if (config('linky.auth.require_user')) {
    $admin->middleware(LinkyAuth::middleware());
}

/**
 * Admin routes
 */
$admin->group(function () {
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
/**
 * The main fallback route
 */
Route::any('{any}', [ContentController::class, 'catchAll'])
    ->where('any', '.*')
    ->name('linky.catch-all')
    ->withoutMiddleware(VerifyCsrfToken::class)
    ->fallback();
