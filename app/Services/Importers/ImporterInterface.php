<?php

namespace App\Services\Importers;

interface ImporterInterface
{
    /**
     * Fetch a single random item and transform into array compatible with Post::create()
     *
     * @return array{title:string, content:string, status:string, source:string, external_id:int}
     */
    public function fetchAndTransform(): array;
}
