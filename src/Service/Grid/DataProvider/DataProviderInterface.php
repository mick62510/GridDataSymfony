<?php

namespace App\Service\Grid\DataProvider;

use App\Service\Grid\DataProvider\Filter\FilterInterface;
use App\Service\Grid\DataProvider\Order\OrderInterface;
use App\Service\Grid\DataProvider\Search\SearchCollection;

interface DataProviderInterface
{
    public function execute(): void;

    public function initFirstAndMaxResult(?int $startResult, ?int $maxResult): void;

    public function getData(): array;

    public function count(): int;

    public function addFilter(FilterInterface $filter): void;

    public function addOrder(OrderInterface $order): void;

    public function initSearch(string $value, SearchCollection $search): void;
}