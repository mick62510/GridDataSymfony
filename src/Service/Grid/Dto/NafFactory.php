<?php

namespace App\Service\Grid\Dto;

use App\Dto\Naf;
use App\Entity\Naf as NafEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NafFactory implements DtoFactoryInterface
{
    /**
     * @param NafEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Naf
    {
        $naf          = new Naf;
        $naf->id      = $item->getId();
        $naf->libelle = $item->getLibelle();

        $naf->actions = [
            'edit' => $urlGenerator->generate('naf.edit', ['id' => $item->getId()]),
        ];

        return $naf;
    }
}