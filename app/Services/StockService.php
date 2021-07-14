<?php


namespace App\Services;


use App\Repositories\Stock\StockInterface;
use App\Services\BaseService;

class StockService extends BaseService
{
    public function __construct(StockInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        $data = $this->repository->getList($params);
        $page = isset($params['page']) ? $params['page'] : 1;
        $data = paging($data,$page);
        return $data;
    }
    public function getParents(){
        return $this->repository->getParents();
    }
}