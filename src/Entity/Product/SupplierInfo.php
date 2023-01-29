<?php

namespace ZoomosApi\Entity\Product;

use ZoomosApi\Entity\Base\WithDateAddTrait;
use ZoomosApi\Entity\Base\WithModelTrait;
use ZoomosApi\Entity\Base\WithNameTrait;
use ZoomosApi\Entity\Base\WithPriceTrait;
use ZoomosApi\Entity\BaseData;

class SupplierInfo extends BaseData
{
    use WithNameTrait;
    use WithModelTrait;
    use WithPriceTrait;
    use WithDateAddTrait;

    public function getVendor(): string
    {
        return $this->getStringField('vendor') ?? '';
    }

    public function getModelCode(): string
    {
        return $this->getStringField('modelCode') ?? '';
    }

    public function getPriceConverted(): int
    {
        return $this->getIntField('priceConverted');
    }

    public function getPriceDiscounted(): int
    {
        return $this->getIntField('priceDiscounted');
    }

    public function getPriceCalculated(): int
    {
        return $this->getIntField('priceCalculated');
    }

    public function getPriceCalculatedMin(): int
    {
        return $this->getIntField('priceCalculatedMin');
    }

    public function getIsWholesalePrice(): bool
    {
        return $this->getBoolField('isWholesalePrice');
    }

    public function getQuantityStr(): string
    {
        return $this->getStringField('quantity') ?? '';
    }

    public function getQuantityInt(): int
    {
        $qnt = trim($this->getQuantityStr(), '<> ');
        $qnt = preg_replace('/[^0-9]/', '', $qnt);

        return (int) $qnt;
    }

    public function getStatus(): string
    {
        return $this->getStringField('status') ?? '';
    }
}
