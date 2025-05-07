<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BookLookupService
{
    public function lookupByIsbn(string $isbn): ?array
    {
        $response = Http::get("https://openlibrary.org/api/books", [
            'bibkeys' => "ISBN:$isbn",
            'format' => 'json',
            'jscmd' => 'data',
        ]);

        $data = $response->json();

        return $data["ISBN:$isbn"] ?? null;
    }
}
