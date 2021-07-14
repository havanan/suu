<?php


namespace App\Services;


use App\Repositories\User\UserInterface;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(UserInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        return $this->repository->getList($params);
    }
    public function getOwner(){
        return $this->repository->getOwner();
    }
}