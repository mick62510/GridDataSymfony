<?php

namespace App\Service\Grid\DataProvider\Search;

interface SearchInterface
{
    public function getField(): string;
    public function setField(string $field);
}