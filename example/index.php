<?php

declare(strict_types=1);

use ZoomosApi\Entity\PriceListItem;
use ZoomosApi\Fetcher\BaseFetcher;
use ZoomosApi\Fetcher\PriceListFetcher;

require __DIR__ . '/../vendor/autoload.php';

$key = 'avtoshina.by-qSuperKeyX';

$response = BaseFetcher::create($key)->execute('GET', 'pricelist', [
    'query' => [
        'all' => 0,
        'offset' => 0,
        'limit' => 10,
    ],
]);
$items = $response->getContentAsArray();
var_dump(count($items));

// ---

$items = PriceListFetcher::create($key)
    ->useWarrantyInfo(0)
    ->useCompetitorInfo(0)
    ->useDeliveryInfo(0)
    ->setOffset(0)
    ->setLimit(10)
    ->getItems();

/** @var PriceListItem $price */
$priceItem = $items[0] ?? null;
var_dump($priceItem?->getVendor()->getName());

die('-');
