<?php

namespace App\Service\Grid\Dto;

use App\Dto\Etablissement;
use App\Entity\Etablissement as EtablissementEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EtablissementFactory implements DtoFactoryInterface
{
    /**
     * @param EtablissementEntity $item
     */
    static public function create($item, UrlGeneratorInterface $urlGenerator): Etablissement
    {
        $etablissement = Etablissement::create($item);

        //TODO -> arrêter les conneries...
        $declarationUrl = $urlGenerator->generate('declarations.create', ['etablissementId' => $item->getId()]);
        if($item->getDeclarations()->count() > 0) {
            $declaration = $item->getDeclarations()->first();
            if($declaration->isValide()) {
                $declarationUrl = $urlGenerator->generate('declarations.resultat', ['etablissementId' => $item->getId(), 'id' => $declaration->getId()]);
            } else {
                $declarationUrl = $urlGenerator->generate('declarations.edit', ['etablissementId' => $item->getId(), 'id' => $declaration->getId()]);
            }
        }

        $etablissement->actions = [
            'show' => $urlGenerator->generate('etablissements.edit', ['id' => $item->getId()]),
            'declaration' => $declarationUrl,
        ];

        return $etablissement;
    }
}
