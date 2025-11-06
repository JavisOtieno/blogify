<?php

namespace App\Services\Importers;

use Illuminate\Support\Facades\Http;

class FakeStoreImporter implements ImporterInterface
{
    public function fetchAndTransform(): array
    {
        // fakestore common IDs ~1..20
        $randomId = rand(1, 20);
        $res = Http::retry(2, 100)->get("https://fakestoreapi.com/products/{$randomId}");

        if ($res->failed() || !$res->ok()) {
            throw new \Exception('FakeStore fetch failed');
        }

        $p = $res->json();

        $content = ($p['description'] ?? '') . "\n\nPrice: {$p['price']}\nCategory: {$p['category']}";

        return [
            'title' => $p['title'] ?? 'Untitled Product',
            'content' => $content,
            'status' => 'draft',
            'source' => 'fakestore',
            'external_id' => (int) ($p['id'] ?? $randomId),
        ];
    }
}
