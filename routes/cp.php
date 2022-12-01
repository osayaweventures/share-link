<?php

use Illuminate\Support\Facades\Route;
use Osayaweventures\ShareLinks\Http\Controllers\ShareLinksCpController;

Route::get(
    'share-links', [ ShareLinksCpController::class, 'edit' ]
)->name('sharelinks.edit');
Route::post(
    'share-links', [ ShareLinksCpController::class, 'update' ]
)->name('sharelinks.update');
