<?php

namespace App\Service\Grid;

use Doctrine\Common\Collections\ArrayCollection;

class Config
{
    public ArrayCollection $columns;
    public ArrayCollection $filters;
    public ArrayCollection $columnActions;

    /**
     * @return ArrayCollection
     */
    public function getColumns(): ArrayCollection
    {
        return $this->columns;
    }

    /**
     * @param ArrayCollection $columns
     */
    public function setColumns(ArrayCollection $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @return ArrayCollection
     */
    public function getFilters(): ArrayCollection
    {
        return $this->filters;
    }

    /**
     * @param ArrayCollection $filters
     */
    public function setFilters(ArrayCollection $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * @return ArrayCollection
     */
    public function getColumnActions(): ArrayCollection
    {
        return $this->columnActions;
    }

    /**
     * @param ArrayCollection $columnActions
     */
    public function setColumnActions(ArrayCollection $columnActions): void
    {
        $this->columnActions = $columnActions;
    }

}