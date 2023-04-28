<?php

namespace App\Service\Grid\DataProvider\Search;

class Search implements SearchInterface
{
    protected string $field;

    public function getField(): string
    {
        return $this->field;
    }

    public function setField(string $field)
    {
        $this->field = $field;
    }
}