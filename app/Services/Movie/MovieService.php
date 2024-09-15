<?php

namespace App\Services\Movie;

use App\Services\Movie\Adapter\FooAdapter;
use App\Services\Movie\Adapter\BarAdapter;
use App\Services\Movie\Adapter\BazAdapter;

class MovieService
{
    public const MOVIE_ADAPTERS = [FooAdapter::class, BarAdapter::class, BazAdapter::class];

    public function __construct(readonly MovieTitleCacheService $cacheManager)
    {
    }

    public function getTitles(): array
    {
        $titles = [];

        foreach (self::MOVIE_ADAPTERS as $adapter) {
            $this->cacheManager->setAdapter(app($adapter));

            $titles = array_merge($titles, $this->cacheManager->getTitles());
        }

        return $titles;
    }
}
