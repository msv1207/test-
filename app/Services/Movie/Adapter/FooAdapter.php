<?php

namespace App\Services\Movie\Adapter;

use External\Foo\Movies\MovieService;

class FooAdapter implements AdapterInterface
{
    public function __construct(readonly MovieService $movieService)
    {
    }

    public function getData(): array
    {
        return $this->movieService->getTitles();
    }
}
