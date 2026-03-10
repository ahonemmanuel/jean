<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;

/*
|--------------------------------------------------------------------------
| Accueil → présentation
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('public.page', 'presentation'));

/*
|--------------------------------------------------------------------------
| Pages statiques publiques
|--------------------------------------------------------------------------
*/

Route::get('/{type}', [PublicPageController::class, 'show'])
    ->name('public.page')
    ->where('type', 'presentation|message|programme|projets|gallery');
