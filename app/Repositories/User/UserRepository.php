<?php


namespace App\Repositories\User;


use App\Models\User;
use App\Repositories\BaseBaseRepository;

class UserRepository extends BaseBaseRepository implements UserInterface
{
    public function __construct(User $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {

        $data = $this->model->orderBy('id');
        if (isset($params['keyword']) && $params['keyword'] != null) {
            $data->where('name','like','%'.$params['keyword'].'%');
        }
        return $data;
    }
    public function getOwner(){
        return $this->model->select('name as label','id as code')->get()->toArray();
    }
}