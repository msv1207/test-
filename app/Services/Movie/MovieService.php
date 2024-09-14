<?php

namespace App\Services\Movie;

use App\Services\Movie\Adapter\FooAdapter;
use App\Services\Movie\Adapter\BarAdapter;
use App\Services\Movie\Adapter\BazAdapter;

class MovieService
{
    public function __construct(readonly MovieCacheManager $cacheManager)
    {
    }

    public function getTitles(): array
    {
        $adapters = [
            app(FooAdapter::class),
            app(BarAdapter::class),
            app(BazAdapter::class)
        ];

        $titles = [];

        foreach ($adapters as $adapter) {
            $this->cacheManager->setAdapter($adapter);

            $titles = array_merge($titles, $this->cacheManager->getTitles());
        }

        return $titles;
    }
}
