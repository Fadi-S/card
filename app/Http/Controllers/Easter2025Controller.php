<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Easter2025Controller extends Controller
{
    public function __invoke()
    {
        return view('cards.easter2025', [
            "video" => "",
        ]);
    }
}
