<?php

namespace App\Service\Grid\DataProvider\Filter;

class Filter implements FilterInterface
{
    private string     $id;
    private string     $field;
    private string|int $value;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField(string $field): void
    {
        $this->field = $field;
    }

    /**
     * @return int|string
     */
    public function getValue(): int|string
    {
        return $this->value;
    }

    /**
     * @param int|string $value
     */
    public function setValue(int|string $value): void
    {
        $this->value = $value;
    }
}