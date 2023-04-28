<?php

namespace App\Service\Grid;

use App\Service\Grid\DataProvider\OrmDataProvider;
use App\Service\Grid\Factory\ConfigFactory;
use Doctrine\ORM\QueryBuilder;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

trait GridTrait
{
    abstract protected function getResourceName(): string;

    abstract protected function getQueryBuilder(): QueryBuilder;

    abstract protected function getUrlGenerator(): UrlGeneratorInterface;

    abstract protected function render(string $view, array $parameters = [], Response $response = null): Response;

    abstract protected function json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse;

    private readonly GridService $gridService;

    public function __construct(GridService $gridService)
    {
        $this->gridService = $gridService;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function initGrid(): void
    {
        $this->gridService->setConfig(ConfigFactory::create($this->getConfig()));
        $this->gridService->setDtoClass($this->getDtoClass());
        $this->gridService->setDataProvider(new OrmDataProvider($this->getQueryBuilder()));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function index(): Response
    {
        $this->initGrid();

        return $this->render($this->getResourceName() . '/index.html.twig', [
            'config'    => $this->gridService->getConfigSerialize(),
            'routeAjax' => $this->getUrlGenerator()->generate($this->getResourceName() . '.ajax'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function ajax(Request $request): JsonResponse
    {
        $this->initGrid();

        $this->gridService->handleRequest($request);
        $this->gridService->execute();

        return $this->json([
            'values'     => $this->gridService->getData(),
            'totalPages' => $this->gridService->totalPages(),
            'count'      => $this->gridService->count(),
            'pageToShow' => $this->gridService->currentPage,
        ]);
    }

    /**
     * @throws Exception
     */
    private function getDtoClass(): string
    {
        if (!defined('static::DTO_NAME')) {
            throw new Exception(sprintf('Constante "%s" non définie dans "%s"', 'DTO_NAME', get_class($this)));
        }

        return static::DTO_NAME;
    }
}
