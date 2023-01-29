<?php

declare(strict_types=1);

namespace ZoomosApi\Fetcher;

use LogicException;
use Symfony\Component\HttpClient\CurlHttpClient;
use ZoomosApi\Http\HttpCurlService;

class BaseFetcher
{
    private const API_URL = 'https://api.zoomos.by/';

    private ?string $key = null;

    public function __construct(
        private readonly HttpCurlService $curlService
    ) {
    }

    public static function create(string $key): static
    {
        $client = new CurlHttpClient();

        $curlService = new HttpCurlService(
            $client
        );

        $curlService->addHeaders([
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/json',
        ]);

        return (new static($curlService))->setKey($key);
    }

    public function setKey(string $key): static
    {
        $this->key = $key;

        return $this;
    }

    public function execute(string $requestType, string $method, array $params = []): HttpCurlService
    {
        $key = $this->key ?? $params['query']['key'] ?? null;

        if (null === $key) {
            throw new LogicException('ZoomosApi: Key is not set');
        }

        $params['query']['key'] = $key;

        return $this->curlService
            ->request(
                $requestType,
                $this->prepareUrl($method),
                $params
            );
    }

    protected function prepareUrl(string $method): string
    {
        return self::API_URL . ltrim($method, '/');
    }
}
