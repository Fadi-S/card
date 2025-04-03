<?php

use App\Http\Controllers\Easter2025Controller;
use App\Http\Controllers\ShowCardController;
use Illuminate\Support\Facades\Route;

Route::get("/easter2025", Easter2025Controller::class)
    ->middleware("signed-url")
    ->name("easter2025");

Route::get("/{card}/{data}", ShowCardController::class)
    ->middleware("signed-url")
    ->where('data', '.*')
    ->name("preview");
