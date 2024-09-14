<?php

namespace App\Services\Movie\Adapter;

use External\Baz\Movies\MovieService;

class BazAdapter implements AdapterInterface
{
    public function __construct(readonly MovieService $movieService)
    {
    }

    public function getData(): array
    {
        return $this->movieService->getTitles()['titles'];
    }
}
