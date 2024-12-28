<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Illuminate\Http\Request;

class ShowCardController extends Controller
{
    public function __invoke($card, $data)
    {
        $name = base64_decode($data);
        $time = [
            "٩ص", // Kobar
            "١١ص", // So8ayarin
            "٩ص أو ١١ص", // Both
        ];

        $schoolYears = Name::query()
            ->where("name", "=", $name)
            ->pluck("school_year")
        ;

        if ($schoolYears->isEmpty()) {
            $time = $time[2];
        }elseif ($schoolYears->doesntContain(3)) {
            $time = $time[0];
        } elseif ($schoolYears->intersect([4, 5, 6])->count() > 0) {
            $time = $time[2];
        } else {
            $time = $time[1];
        }

        $mass = str("مستنيك فى قداس العيد يوم **1** الساعة **2**.")
            ->replace("1", "الاثنين ٦ يناير")
            ->replace("2", "٧:٣٠م")
            ->toString()
        ;
        $party = str("و نتقابل كمان في الحفلة يوم **1** الساعة **2**.")
            ->replace("1", "الثلاثاء ٧ يناير")
            ->replace("2", $time)
            ->toString()
        ;

        $after = "";

        return view("cards.$card", [
            "name" => $name,
            "nameShort" => str($name)->split("/\s+/")->splice(0, 1)->join(" "),
            "mass" => $mass,
            "party" => $party,
            "after" => $after,
        ]);
    }
}
