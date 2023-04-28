<?php

namespace App\Service\Grid\Dto;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DtoFactoryInterface
{
    static public function create($item, UrlGeneratorInterface $urlGenerator);
}