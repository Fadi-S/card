<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Links
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

    public function getLink($path): ?string
    {
        if (! $path) {
            return null;
        }

        $expires = now()->addMinutes(60);

        return Cache::remember($path, $expires, fn() => $this->signUrl($path, $expires)
        );
    }
}
