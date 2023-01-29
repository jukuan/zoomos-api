<?php

declare(strict_types=1);

namespace ZoomosApi\Fetcher;

use ZoomosApi\Entity\PriceListItem;
use ZoomosApi\Http\HttpCurlService;

/**
 * Documentation: https://help.zoomos.by/export/api/doc
 */
class PriceListFetcher extends BaseFetcher
{
    private const METHOD = 'pricelist';

    private array $queryParams = [
    ];

    public function useAll(int $value = 1): static
    {
        $this->queryParams['all'] = $value;

        return $this;
    }

    public function useSupplierInfo(int $value = 0): static
    {
        $this->queryParams['supplierInfo'] = 0;

        return $this;
    }

    public function useWarrantyInfo(int $value = 0): static
    {
        $this->queryParams['warrantyInfo'] = 0;

        return $this;
    }

    public function useCompetitorInfo(int $value = 0): static
    {
        $this->queryParams['competitorInfo'] = 0;

        return $this;
    }

    public function useDeliveryInfo(int $value = 0): static
    {
        $this->queryParams['deliveryInfo'] = 0;

        return $this;
    }

    public function setOffset(int $value): static
    {
        $this->queryParams['offset'] = $value;

        return $this;
    }

    public function setLimit(int $value): static
    {
        $this->queryParams['limit'] = $value;

        return $this;
    }

    public function run(array $params = []): HttpCurlService
    {
        $queryParams = array_merge($params['query'] ?? [], $this->queryParams);

        if (count($queryParams) > 0) {
            $params['query'] = $queryParams;
        } else {
            unset($params['query']);
        }

        return $this->execute('GET', self::METHOD, $params);
    }

    public function getItems(): array
    {
        $items = $this->run()->getContentAsArray();

        return array_map(static function (array $item): PriceListItem {
            return new PriceListItem($item);
        }, $items);
    }
}
