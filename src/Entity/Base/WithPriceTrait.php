<?php

declare(strict_types=1);

namespace ZoomosApi\Entity\Base;

/**
 * @property-read array $fields
 * @method string|null getStringField(string $key, ?string $default = null)
 * @method int|null getIntField(string $key, ?int $default = null)
 */
trait WithPriceTrait
{
    public function getPrice(): int
    {
        return $this->getIntField('price') ?? 0;
    }

    public function getPriceCurrency(): string
    {
        return $this->getStringField('currency') ?? '';
    }
}
