<?php

declare(strict_types=1);

namespace ZoomosApi\Entity;

use DateTimeImmutable;

abstract class BaseData
{
    protected array $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function getField(string $key, $default = null)
    {
        return $this->fields[$key] ?? $default;
    }

    public function getIntField(string $key, ?int $default = null): ?int
    {
        $value = $this->getField($key, $default);

        return null === $value ? null : (int) $value;
    }

    public function getStringField(string $key, ?string $default = null): ?string
    {
        $value = $this->getField($key, $default);

        return null === $value ? null : (string) $value;
    }

    public function getBoolField(string $key, ?bool $default = null): ?bool
    {
        $value = $this->getField($key, $default);

        return null === $value ? null : in_array($value, [true, 'true', '1'], true);
    }

    public function getId(): int
    {
        return (int) ($this->fields['id'] ?? 0);
    }

    /**
     * Converts values like 1633360048000 or 1633340991000 to DateTimeImmutable object.
     */
    protected function getDateTimeField(string $key): ?DateTimeImmutable
    {
        $ts = (int) ($this->fields[$key] ?? 0);
        $ts = $ts / 1000;

        if ($ts === 0) {
            return null;
        }

        return DateTimeImmutable::createFromFormat('U', (string) $ts) ?? null;
    }

    public function setField(string $key, $value): static
    {
        $this->fields[$key] = $value;

        return $this;
    }

    public function __get($name)
    {
        $methodName = $this->camelCase($name);
        $methodName = ucfirst($methodName);
        $methodName = sprintf('get%s', $methodName);

        if (method_exists(get_called_class(), $methodName)) {
            return $this->{$methodName}();
        }

        return $this->getField($name);
    }

    public function __set($name, $value)
    {
        return $this->setField($name, $value);
    }

    protected function camelCase(string $name): string
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }
}
