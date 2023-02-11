<?php

use Illegal\Linky\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;


Route::get('/{slug}', [ContentController::class, 'catchAll']);
