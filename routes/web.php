<?php

use App\Http\Controllers\ShowCardController;
use Illuminate\Support\Facades\Route;

Route::get("/{card}/{data}", ShowCardController::class)
    ->middleware("signed-url")
    ->where('data', '.*')
    ->name("preview");
