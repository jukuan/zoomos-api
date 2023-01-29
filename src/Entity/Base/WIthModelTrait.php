<?php

declare(strict_types=1);

namespace ZoomosApi\Entity\Base;

/**
 * @property-read array $fields
 * @method string|null getStringField(string $key, ?string $default = null)
 */
trait WIthModelTrait
{
    public function getModel(): string
    {
        return $this->getStringField('model') ?? '';
    }
}
