<?php

namespace App\Service\Grid\DataProvider\Order;

interface OrderInterface
{
    public function getField(): string;

    public function setField(string $id): void;

    public function getOrder(): string;

    public function setOrder(string $order): void;
}