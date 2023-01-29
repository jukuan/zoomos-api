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
        $model = $this->getStringField('model') ?? '';

        // escape slashes before inserting to database
        $model = str_replace('\\', '\\\\', $model);
        $model = str_replace('/', '\\/', $model);

        return trim($model);
    }
}
