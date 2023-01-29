<?php

declare(strict_types=1);

namespace ZoomosApi\Entity\Base;

/**
 * @property-read array $fields
 * @method string|null getStringField(string $key, ?string $default = null)
 */
trait WithNameTrait
{
    public function getName(): string
    {
        return $this->getStringField('name') ?? '';
    }
}
