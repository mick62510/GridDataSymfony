<?php

namespace App\Service\Grid\Dto;

use App\Dto\Activite;
use App\Entity\Activite as ActiviteEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ActiviteFactory implements DtoFactoryInterface
{
    /**
     * @param ActiviteEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Activite
    {
        $activite             = new Activite;
        $activite->id         = $item->getId();
        $activite->libelle    = $item->getLibelle();
        $activite->idcc       = $item->getIdcc()->getId();
        $activite->naf        = $item->getNaf()->getId();
        $activite->collecteur = $item->getTaxes()->first() ? $item->getTaxes()->first()->getCollecteur()->getRaisonSociale1() : '';

        $activite->actions = [
            'edit' => $urlGenerator->generate('activites.edit', ['id' => $item->getId()]),
        ];

        return $activite;
    }
}