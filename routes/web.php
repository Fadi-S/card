<?php

use App\Http\Controllers\ShowCardController;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\Route;

Route::get("/{card}/{data}", ShowCardController::class)
    ->middleware(ValidateSignature::class)
    ->name("preview");
