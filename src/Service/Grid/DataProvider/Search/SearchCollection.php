<?php

namespace App\Service\Grid\DataProvider\Search;

use Doctrine\Common\Collections\ArrayCollection;

class SearchCollection extends ArrayCollection
{
    /**
     * @param Search $element
     * @return bool
     */
    public function add($element): bool
    {
        return parent::add($element);
    }
}