<?php

namespace App\Service\Grid\Factory;

use App\Service\Grid\Filter;
use Doctrine\Common\Collections\ArrayCollection;

class FilterFactory
{
    public static function create(array $filtersArray): ArrayCollection
    {
        $array = [];

        foreach ($filtersArray as $id => $filterArray) {
            $filter = new Filter();
            $filter->setTitle($filterArray['title']);
            $filter->setOptions($filterArray['options']);
            $filter->setType($filterArray['type']);

            $array[$id] = $filter;
        }

        return new ArrayCollection($array);
    }
}