<?php

namespace App\Service\Grid;

use App\Service\Grid\DataProvider\DataProviderInterface;
use App\Service\Grid\DataProvider\Filter\Filter;
use App\Service\Grid\DataProvider\Order\Order;
use App\Service\Grid\DataProvider\Search\Search;
use App\Service\Grid\DataProvider\Search\SearchCollection;
use App\Service\Grid\Dto\DtoFactoryInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class GridService
{
    const PAGINATOR_PER_PAGE = 10;
    public ?string               $dtoClass = null;
    public array|object|null     $data;
    public ?string               $globalSearch;
    public array                 $filters;
    public ?string               $orderBy;
    private Config               $config;
    public DataProviderInterface $dataProvider;
    public ?int                  $currentPage;
    private int                  $count;
    private int                  $totalPages;
    private SerializerInterface  $serializer;
    public UrlGeneratorInterface $urlGenerator;

    public function __construct(SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator)
    {
        $this->serializer   = $serializer;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function handleRequest(Request $request): void
    {
        $this->globalSearch = $request->get('search');
        $this->initFilters(json_decode($request->get('filters', [])));
        $this->initOrders(json_decode($request->get('orderBy', [])));
        $this->initSearch($request->get('search'));
        $this->currentPage = $request->get('page');
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->totalPages = ceil($this->dataProvider->count() / self::PAGINATOR_PER_PAGE);

        $this->dataProvider->initFirstAndMaxResult($this->getStartResult(), GridService::PAGINATOR_PER_PAGE);

        $this->dataProvider->execute();

        $this->data  = $this->dataProvider->getData();
        $this->count = $this->dataProvider->count();
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getData(): array
    {
        if (is_null($this->dtoClass)) {
            return $this->data;
        }

        $array = [];

        foreach ($this->data as $item) {
            /** @var DtoFactoryInterface $factoryName */
            $factoryName = $this->getDtoFactory();
            $array[]     = $factoryName::create($item, $this->urlGenerator);
        }

        return $array;
    }

    /**
     * @throws Exception
     */
    public function getDtoFactory(): string
    {
        $path      = explode('\\', $this->dtoClass);
        $shortName = array_pop($path);

        $name = __NAMESPACE__ . '\\Dto\\' . $shortName . 'Factory';

        if (!class_exists($name)) {
            throw new Exception(sprintf('La classe "%s" n\'existe pas.', $name));
        }

        if (!is_subclass_of($name, DtoFactoryInterface::class)) {
            throw new Exception(sprintf('"%s" doit implémenter "%s".', $name, DtoFactoryInterface::class));
        }

        return $name;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function totalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    private function getStartResult(): int
    {
        if (!$this->totalPages) {
            return $this->totalPages;
        }

        $nextPage = (($this->currentPage < $this->totalPages) ? $this->currentPage : $this->totalPages);

        return ($nextPage - 1) * GridService::PAGINATOR_PER_PAGE;
    }

    public function initFilters($filtersValues): void
    {
        foreach ($filtersValues as $id => $value) {
            /** @var Column $column */
            $column = $this->config->getColumns()->get($id);

            $filter = new Filter();
            $filter->setField($column->getField());
            $filter->setId($id);
            $filter->setValue($value);

            $this->dataProvider->addFilter($filter);
        }
    }

    public function initOrders($orders): void
    {
        foreach ($orders as $id => $type) {
            /** @var Column $column */
            $column = $this->config->getColumns()->get($id);

            $order = new Order();
            $order->setField($column->getField());
            $order->setOrder($type);

            $this->dataProvider->addOrder($order);
        }
    }

    public function initSearch(string $searchValue): void
    {
        if ($searchValue) {
            $collection = new SearchCollection();
            /** @var Column $column */
            foreach ($this->config->getColumns() as $column) {
                $search = new Search();
                $search->setField($column->getField());
                $collection->add($search);
            }
            $this->dataProvider->initSearch($searchValue, $collection);
        }
    }

    /**
     * @return string
     */
    public function getConfigSerialize(): string
    {
        return $this->serializer->serialize($this->getConfig(), 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['field']]);
    }

    /**
     * @return string|null
     */
    public function getDtoClass(): ?string
    {
        return $this->dtoClass;
    }

    /**
     * @param string|null $dtoClass
     */
    public function setDtoClass(?string $dtoClass): void
    {
        $this->dtoClass = $dtoClass;
    }

    /**
     * @return DataProviderInterface
     */
    public function getDataProvider(): DataProviderInterface
    {
        return $this->dataProvider;
    }

    /**
     * @param DataProviderInterface $dataProvider
     */
    public function setDataProvider(DataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }
}
