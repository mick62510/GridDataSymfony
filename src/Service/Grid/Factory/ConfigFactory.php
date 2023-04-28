<?php

namespace App\Service\Grid\Factory;

use App\Service\Grid\Config;

class ConfigFactory
{
    public static function create(array $arrayConfig): Config
    {
        $columns      = ColumnFactory::createArrayCollection($arrayConfig['columns']);
        $filters      = FilterFactory::create(array_key_exists('filters', $arrayConfig) ? $arrayConfig['filters'] : []);
        $columnAction = ColumnActionsFactory::createArrayCollection(array_key_exists('actions', $arrayConfig) ? $arrayConfig['actions'] : []);
        $config       = new Config();

        $config->setColumns($columns);
        $config->setFilters($filters);
        $config->setColumnActions($columnAction);

        return $config;
    }
}