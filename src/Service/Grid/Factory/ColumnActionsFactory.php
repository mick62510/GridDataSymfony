<?php

namespace App\Service\Grid\Factory;

use App\Service\Grid\ColumnActions;
use Doctrine\Common\Collections\ArrayCollection;

class ColumnActionsFactory
{
    /**
     * @param array $actions
     * @return ArrayCollection
     */
    public static function createArrayCollection(array $actions): ArrayCollection
    {
        $columnsToCollection = [];
        foreach ($actions as $id => $actionData) {
            $action = new ColumnActions();
            $action->setColor($actionData['color']);
            $action->setIcon($actionData['icon']);
            $columnsToCollection[$id] = $action;
        }

        return new ArrayCollection($columnsToCollection);
    }
}