<?php

namespace App\Service\Grid\Dto;

use App\Dto\Idcc;
use App\Entity\Idcc as IdccEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class IdccFactory implements DtoFactoryInterface
{
    /**
     * @param IdccEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Idcc
    {
        $idcc          = new Idcc;
        $idcc->id      = $item->getId();
        $idcc->libelle = $item->getLibelle();

        $idcc->actions = [
            'edit' => $urlGenerator->generate('idcc.edit', ['id' => $item->getId()]),
        ];

        return $idcc;
    }
}