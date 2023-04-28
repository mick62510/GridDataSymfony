<?php

namespace App\Service\Grid\Dto;

use App\Dto\Abonnement;
use App\Entity\Abonnement as AbonnementEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AbonnementFactory implements DtoFactoryInterface
{
    /**
     * @param AbonnementEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Abonnement
    {
        $abonnement              = new Abonnement();
        $abonnement->id          = $item->getId();
        $abonnement->comptableId = $item->getComptable()->getId();

        $abonnement->actions = [
            'edit' => $urlGenerator->generate('abonnements.edit', ['id' => $item->getId()]),
        ];

        return $abonnement;
    }
}