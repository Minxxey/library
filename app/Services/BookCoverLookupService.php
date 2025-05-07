<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BookCoverLookupService
{

    /**
     * @throws ConnectionException
     */
    public function downloadAndStoreCoverImage(string $isbn): ?string
    {
        //see if cover already exists
        if(Storage::disk('public')->exists('covers/' . "{$isbn}.jpg")) {
            return "covers/{$isbn}.jpg";
        }

        $url = "https://covers.openlibrary.org/b/isbn/{$isbn}-M.jpg";
        $response = Http::get($url);

        if ($response->successful()) {
            $filename = "{$isbn}.jpg";
            Storage::disk('public')->put("covers/{$filename}", $response->body());

            return "covers/{$filename}";
        }

        return null;
    }
}
