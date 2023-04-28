<?php

namespace App\Service\Grid\Dto;

use App\Dto\Comptable;
use App\Entity\Comptable as ComptableEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ComptableFactory implements DtoFactoryInterface
{
    /**
     * @param ComptableEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Comptable
    {
        $comptable = Comptable::create($item);

        $comptable->actions = [
            'show' => $urlGenerator->generate('comptables.edit', ['id' => $item->getId()]),
        ];

        return $comptable;
    }
}
