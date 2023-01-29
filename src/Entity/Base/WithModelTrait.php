<?php

declare(strict_types=1);

namespace ZoomosApi\Entity\Base;

/**
 * @property-read array $fields
 * @method string|null getStringField(string $key, ?string $default = null)
 */
trait WithModelTrait
{
    public function getModel(): string
    {
        $model = $this->getStringField('model') ?? '';

        return $this->escapeString($model);
    }

    protected function escapeString(string $value): string
    {
        $value = str_replace('\\', '\\\\', $value);
        $value = str_replace('/', '\\/', $value);

        return trim($value);
    }
}
