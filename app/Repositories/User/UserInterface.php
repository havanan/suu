<?php


namespace App\Repositories\User;


use App\Repositories\BaseRepositoryInterface;

interface UserInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getOwner();
}