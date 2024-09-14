<?php

namespace App\Services\Movie\Adapter;

use External\Bar\Movies\MovieService;

class BarAdapter implements AdapterInterface
{
    public function __construct(readonly MovieService $movieService)
    {
    }

    public function getData(): array
    {
        $collection = collect($this->movieService->getTitles()['titles']);

        return $collection->pluck('title')->all();
    }
}
