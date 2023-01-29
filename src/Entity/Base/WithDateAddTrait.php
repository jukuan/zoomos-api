<?php

declare(strict_types=1);

namespace ZoomosApi\Entity\Base;

use DateTimeImmutable;

/**
 * @property-read array $fields
 * @method DateTimeImmutable|null getDateTimeField(string $key, ?string $default = null)
 */
trait WithDateAddTrait
{
    public function getDateAdd(): ?DateTimeImmutable
    {
        return $this->getDateTimeField('dateAddMillis');
    }
}
