<?php

namespace App\Http\Controllers;

use App\Links;
use App\Models\Name;
use Aws\CloudFront\CloudFrontClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Spatie\UrlSigner\Laravel\Facades\UrlSigner;

class ShowCardController extends Controller
{
    private Links $links;

    public function __construct(Links $links)
    {
        $this->links = $links;
    }

    public function __invoke($card, $data)
    {
        $name = base64_decode($data);
        $time = [
            "٩:٣٠ص", // Kobar
            "١١:٣٠ص", // So8ayarin
            "٩:٣٠ص أو ١١:٣٠ص", // Both
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

        $mass = str("مستنيك فى قداس العيد يوم **1** 3 الساعة **2**.")
            ->replace("1", "الاثنين ٦ يناير")
            ->replace("2", "٧:٣٠م")
            ->replace("3", "\n\r")
            ->toString()
        ;
        $party = str("و نتقابل كمان في الحفلة يوم **1** 3 الساعة **2**.")
            ->replace("1", "الثلاثاء ٧ يناير")
            ->replace("2", $time)
            ->replace("3", "\n\r")
            ->toString()
        ;

        $after = "";

        $nameShort = str($name)->split("/\s+/")->splice(0, 1)->join(" ");
        if(strtolower($name) === "j6") {
            $nameShort = "اسرة دانيال النبي و الثلاثة فتية";
        }

        return view("cards.$card", [
            "name" => $name,
            "nameShort" => $nameShort,
            "mass" => $mass,
            "party" => $party,
            "after" => $after,
            "video" => $this->links->getLink("video_christmas2025.mp4"),
        ]);
    }
}
