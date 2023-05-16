<?php

declare(strict_types=1);

namespace ZoomosApi\Http;

use Exception;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpCurlService
{
    private int $responseCode = 0;

    private array $headers = [];

    private ?Exception $exception = null;

    private ?ResponseInterface $response = null;

    private string $lastRequest = '';

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    public function reset(): void
    {
        $this->responseCode = 0;
        $this->headers = [];
        $this->exception = null;
        $this->response = null;
        $this->lastRequest = '';
    }

    public function request(string $requestType, string $url, array $options = []): static
    {
        if (count($this->headers) > 0 || isset($options['headers'])) {
            $options['headers'] = array_merge($this->headers, $options['headers'] ?? []);
        }

        $this->saveLastRequest($requestType, $url, $options);

        try {
            $this->response = $this->httpClient->request($requestType, $url, $options);
            $this->responseCode = (int)$this->response->getStatusCode();
            $this->headers = $this->response->getHeaders();
        } catch (ExceptionInterface $e) {
            $this->exception = $e;
            $this->responseCode = (int)$e->getCode();
        }

        return $this;
    }

    public function getContent(): ?string
    {
        try {
            return $this->response?->getContent();
        } catch (ExceptionInterface $e) {
            $this->exception = $e;
            $this->responseCode = 0;

            return null;
        }
    }

    public function getContentAsArray(): array
    {
        try {
            return $this->response?->toArray() ?? [];
        } catch (ExceptionInterface $e) {
            $this->exception = $e;
            $this->responseCode = 0;

            return [];
        }
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getLastRequest(): string
    {
        return $this->lastRequest;
    }

    public function isSuccessful(): bool
    {
        return $this->responseCode >= 200 && $this->responseCode < 300;
    }

    public function hasException(): bool
    {
        return null !== $this->exception;
    }

    public function getErrorMessage(): ?string
    {
        return $this->exception?->getMessage();
    }

    protected function saveLastRequest(string $requestType, string $url, array $params): void
    {
        $this->lastRequest = sprintf(
            '%s: %s with %d headers and %d other params.',
            $requestType,
            $url,
            count($params['headers'] ?? []),
            array_diff(array_keys($params), ['headers'])
        );
    }

    public function addHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }
}
