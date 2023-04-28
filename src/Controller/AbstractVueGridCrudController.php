<?php

namespace App\Controller\Crud;

use App\Service\Grid\GridService;
use App\Service\Grid\GridTrait;
use Exception;

abstract class AbstractVueGridCrudController extends AbstractVueCrudController
{
    use GridTrait {
        __construct as __gridConstruct;
    }

    /**
     * @throws Exception
     */
    public function __construct(GridService $gridService) {
        $this->__gridConstruct($gridService);
    }
}