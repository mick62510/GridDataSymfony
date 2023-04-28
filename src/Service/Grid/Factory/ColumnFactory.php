<?php

namespace App\Service\Grid\Factory;

use App\Service\Grid\Column;
use Doctrine\Common\Collections\ArrayCollection;

class ColumnFactory
{
    /**
     * @param array $columns
     * @return ArrayCollection
     */
    public static function createArrayCollection(array $columns): ArrayCollection
    {
        $columnsToCollection = [];
        foreach ($columns as $id => $columnData) {
            $column = new Column();
            $column->setTitle(array_key_exists('title',$columnData) ? $columnData['title']: '');
            $column->setField(array_key_exists('field',$columnData) ? $columnData['field']: '');
            $column->setDefault(array_key_exists('default',$columnData) ? $columnData['default']: false);
            $column->setHidden(array_key_exists('hidden',$columnData) ? $columnData['hidden']: false);

            $columnsToCollection[$id] = $column;
        }

        return new ArrayCollection($columnsToCollection);
    }
}