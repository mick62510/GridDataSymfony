<?php

namespace App\Controller;

use App\Controller\Crud\AbstractVueGridCrudController;
use App\Entity\Collecteur;
use App\Form\CollecteurType;
use App\Dto\Collecteur as CollecteurDto;
use App\Repository\CollecteurRepository;
use App\Repository\IdccRepository;
use Doctrine\ORM\QueryBuilder;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method CollecteurRepository getRepository()
 */
class CollecteurController extends AbstractVueGridCrudController implements DataAutocompleteInterface
{
    protected const ENTITY_NAME           = Collecteur::class;
    protected const RESOURCE_NAME         = 'collecteurs';
    protected const FORM_TYPE             = CollecteurType::class;
    protected const CREATED_FLASH_MESSAGE = 'Collecteur créé';
    protected const UPDATED_FLASH_MESSAGE = 'Collecteur mis à jour';
    protected const DTO_NAME              = CollecteurDto::class;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function dataAutoComplete(Request $request): JsonResponse
    {
        $search = $request->query->get('search');

        $return = $this->getEntityManager()
                       ->getRepository(static::ENTITY_NAME)
                       ->createQueryBuilder('c')
                       ->select('c.id, CONCAT(c.id, \' - \', c.raisonSociale1) AS name')
                       ->where('c.id LIKE :search')
                       ->orWhere('c.raisonSociale1 LIKE :search')
                       ->setParameter('search', "%$search%")
                       ->getQuery()
                       ->getResult();

        return $this->json(['results' => $return]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->getRepository()->createQueryBuilder('c');
    }

    public function getConfig(): array
    {
        return [
            'columns' => [
                'id'                  => [
                    'title'   => 'Id',
                    'field'   => 'c.id',
                    'default' => true,
                ],
                'raisonSociale1'      => [
                    'title'   => 'Raison sociale',
                    'field'   => 'c.raisonSociale1',
                    'default' => true,
                ],
                'raisonSociale2'      => [
                    'title' => 'Raison sociale complément',
                    'field' => 'c.raisonSociale2',
                ],
                'adresse1'            => [
                    'title'   => 'Adresse',
                    'field'   => 'c.adresse1',
                    'default' => true,
                ],
                'adresse2'            => [
                    'title' => 'Adresse 2',
                    'field' => 'c.adresse2',
                ],
                'adresse3'            => [
                    'title' => 'Adresse 3',
                    'field' => 'c.adresse3',
                ],
                'codePostal'          => [
                    'title'   => 'Code Postal',
                    'field'   => 'c.codePostal',
                    'default' => true,
                ],
                'ville'               => [
                    'title'   => 'Commune',
                    'field'   => 'c.ville',
                    'default' => true,
                ],
                'telephone'           => [
                    'title' => 'Téléphone',
                    'field' => 'c.telephone',
                ],
                'telecopie'           => [
                    'title' => 'Télécopie',
                    'field' => 'c.telecopie',
                ],
                'adresseElectronique' => [
                    'title'   => 'email',
                    'field'   => 'c.adresseElectronique',
                    'default' => true,
                ],
            ],
            'filters' => [],
            'actions' => [
                'edit' => [
                    'color' => 'edit',
                    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " viewBox="0 0 20 20" fill="currentColor">
                                 <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                               </svg>',
                ],
            ],
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function select(Request $request): Response
    {
        $q = $request->query->get('q');

        $items      = [];
        $totalCount = 0;

        foreach ($this->getRepository()->findForSelect($q) as $idcc) {
            $items[] = [
                'value'    => $idcc->getId(),
                'text' => sprintf('%s - %s', $idcc->getId(), $idcc->getRaisonSociale1()),
            ];

            $totalCount++;
        }

        return new JsonResponse(['incomplete_results' => false, 'items' => $items, 'total_count' => $totalCount]);
    }
}