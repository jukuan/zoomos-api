<?php

declare(strict_types=1);

namespace ZoomosApi\Entity;

use DateTimeImmutable;
use ZoomosApi\Entity\Base\WithModelTrait;
use ZoomosApi\Entity\Base\WithPriceTrait;
use ZoomosApi\Entity\Product\Category;
use ZoomosApi\Entity\Product\SupplierInfo;
use ZoomosApi\Entity\Product\Vendor;

class PriceListItem extends BaseData
{
    use WithModelTrait;
    use WithPriceTrait;

    private Vendor $vendor;

    private Category $category;

    private ?SupplierInfo $supplierInfo = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->vendor = new Vendor($data['vendor'] ?? []);
        $this->category = new Category($data['category'] ?? []);

        if (isset($data['supplierInfo']) && is_array($data['supplierInfo'])) {
            $this->supplierInfo = new SupplierInfo($data['supplierInfo']);
        }
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getSupplierInfo(): ?SupplierInfo
    {
        return $this->supplierInfo;
    }

    public function getTypePrefix(): string
    {
        return $this->getStringField('typePrefix') ?? '';
    }

    public function getLinkRewrite(): string
    {
        return $this->getStringField('linkRewrite') ?? '';
    }

    public function getStatus(): int
    {
        return $this->getIntField('status') ?? 0;
    }

    public function isNew(): bool
    {
        return (bool) $this->getIntField('isNew');
    }

    public function getIsPriceFixed(): bool
    {
        return (bool) $this->getIntField('isPriceFixed');
    }

    public function getImage(): string
    {
        return $this->getStringField('image') ?? '';
    }

    public function getDateAddMillis(): ?DateTimeImmutable
    {
        return $this->getDateTimeField('dateAddMillis');
    }

    public function getDateUpdMillis(): ?DateTimeImmutable
    {
        return $this->getDateTimeField('dateUpdMillis');
    }

    public function getItemDateAddMillis(): ?DateTimeImmutable
    {
        return $this->getDateTimeField('itemDateAddMillis');
    }

    public function getItemDateUpdMillis(): ?DateTimeImmutable
    {
        return $this->getDateTimeField('itemDateUpdMillis');
    }
}
