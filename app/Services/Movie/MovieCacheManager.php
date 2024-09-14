<?php

namespace App\Services\Movie;

use Illuminate\Cache\CacheManager;
use App\Services\Movie\Adapter\AdapterInterface;
use External\Bar\Exceptions\ServiceUnavailableException;

class MovieCacheManager
{
    private AdapterInterface $adapter;
    private const UPDATE_TITLES_CACHE = 60 * 60 * 1000; // 60 min
    public function __construct(readonly CacheManager $cacheManager)
    {

    }

    public function setAdapter(AdapterInterface $adapter): void
    {
        $this->adapter = $adapter;
    }

    public function getTitles(): array
    {
        $titles = $this->cacheManager->get(get_class($this->adapter)) ?? [];

        if (time() - ($titles['time'] ?? 0) > self::UPDATE_TITLES_CACHE) {
            try {
                $titles = $this->adapter->getData();
                $this->setTitles($titles);
            } catch (ServiceUnavailableException $exception) {
                logger($exception);

                if ($titles = []) {
                    throw new NotStoredAndUnavailableException();
                }
            }
        }

        unset($titles['time']);

        return $titles;
    }

    private function setTitles(array $titles): void
    {
        $data = array_merge($titles, ['time' => time()]);

        if (!$this->cacheManager->set(get_class($this->adapter), $data)){
            throw new \Exception();
        }
    }
}
