<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Aws\CloudFront\CloudFrontClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Spatie\UrlSigner\Laravel\Facades\UrlSigner;

class ShowCardController extends Controller
{
    private function signUrl(?string $path, \DateTimeInterface $ttl) : ?string
    {
        if(! $path) {
            return null;
        }

        if(! ($keyPair = config('filesystems.cloudfront.key_pair_id'))) {
            return Storage::temporaryUrl($path, $ttl);
        }

        $resourceKey = 'https://' . config('filesystems.cloudfront.domain') . '/' . $path;

        $cloudFrontClient = new CloudFrontClient([
            'profile' => 'default',
            'version' => '2018-06-18',
            'region' => config('filesystems.disks.s3.region'),
        ]);

        return $cloudFrontClient->getSignedUrl([
            'url' => $resourceKey,
            'expires' => $ttl->getTimestamp(),
            'private_key' => config('filesystems.cloudfront.private_key'),
            'key_pair_id' => $keyPair,
        ]);
    }

    private function getLink($path): ?string
    {
        if (! $path) {
            return null;
        }

        $expires = now()->addMinutes(60);

        return Cache::remember($path, $expires, fn() => $this->signUrl($path, $expires)
        );
    }

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
            "video" => $this->getLink("video_christmas2025.mov"),
        ]);
    }
}
