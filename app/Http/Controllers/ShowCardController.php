<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowCardController extends Controller
{
    public function __invoke($card, $data)
    {
        return view("cards.$card", [
            'name' => base64_decode($data),
        ]);
    }
}
