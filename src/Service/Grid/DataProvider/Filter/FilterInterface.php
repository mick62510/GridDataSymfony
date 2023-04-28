<?php

namespace App\Service\Grid\DataProvider\Filter;

interface FilterInterface
{
    public function getId(): string;

    /**
     * @param string $id
     */
    public function setId(string $id): void;

    /**
     * @return string
     */
    public function getField(): string;

    /**
     * @param string $field
     */
    public function setField(string $field): void;

    /**
     * @return int|string
     */
    public function getValue(): int|string;

    /**
     * @param int|string $value
     */
    public function setValue(int|string $value): void;
}