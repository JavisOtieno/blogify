<?php

namespace App\Services\Importers;

use Illuminate\Support\Facades\Http;

class JsonPlaceholderImporter implements ImporterInterface
{
    public function fetchAndTransform(): array
    {
        $randomId = rand(1, 100);
        $res = Http::retry(2, 100)->get("https://jsonplaceholder.typicode.com/posts/{$randomId}");

        if ($res->failed() || !$res->ok()) {
            throw new \Exception('JSONPlaceholder fetch failed');
        }

        $data = $res->json();

        return [
            'title' => $data['title'] ?? 'Untitled',
            'content' => $data['body'] ?? '',
            'status' => 'draft',
            'source' => 'jsonplaceholder',
            'external_id' => (int) ($data['id'] ?? $randomId),
        ];
    }
}
