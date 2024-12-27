<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowCardController extends Controller
{
    public function __invoke($card, $data)
    {
        $name = base64_decode($data);

        $text = "بابا يسوع مستنيك فى حفلة عيد ميلاده  اللى بتبدأ فى القداس يوم …. الساعه ….و نتقابل كمان يوم … الساعه ..
عشان هيقدملك هديته هو مستني تقدمله قلبك هدية";

        return view("cards.$card", [
            "name" => $name,
            "early" => false,
        ]);
    }
}
