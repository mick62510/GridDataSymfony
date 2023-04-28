<?php

namespace App\Service\Grid\Dto;

use App\Dto\Grid\Collecteur;
use App\Entity\Collecteur as CollecteurEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CollecteurFactory implements DtoFactoryInterface
{
    /**
     * @param CollecteurEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Collecteur
    {
        $collecteur                      = new Collecteur();
        $collecteur->id                  = $item->getId();
        $collecteur->raisonSociale1      = $item->getRaisonSociale1();
        $collecteur->raisonSociale2      = $item->getRaisonSociale2();
        $collecteur->adresse1            = $item->getAdresse1();
        $collecteur->adresse2            = $item->getAdresse2();
        $collecteur->adresse3            = $item->getAdresse3();
        $collecteur->codePostal          = $item->getCodePostal();
        $collecteur->ville               = $item->getVille();
        $collecteur->telephone           = $item->getTelephone();
        $collecteur->telecopie           = $item->getTelecopie();
        $collecteur->adresseElectronique = $item->getAdresseElectronique();

        $collecteur->actions = [
            'edit' => $urlGenerator->generate('collecteurs.edit', ['id' => $item->getId()]),
        ];

        return $collecteur;
    }
}
