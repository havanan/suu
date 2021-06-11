<?php


namespace App\Services;


use App\Repositories\BaseRepositoryInterface;

class BaseService
{
    protected $repository;
    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function getModel()
    {
        return $this->repository->getModel();
    }

    public function fetchAll(array $columns = ['*'])
    {
        return $this->repository->fetchAll($columns);
    }

    public function fetchList(array $columns = ['*'], $offset = 0)
    {
        return $this->repository->fetchList($columns, $offset = 0);
    }

    public function findById($id, array $columns = ['*'])
    {
        return $this->repository->findById($id, $columns);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function insert(array $data)
    {
        return $this->repository->insert($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(array $data)
    {
        return $this->repository->delete($data);
    }

    public function paginateList($params)
    {
        $page = isset($params['page']) ? $params['page'] : config('common.page_default');

        return $this->repository->paginateList($page);
    }

    public function paginateListWithPerPage($page = null, $perPage = 10, array $columns = ['*'])
    {
        return $this->repository->paginateListWithPerPage($page, $perPage, $columns);
    }

    public function firstWhere(array $where, $columns = ['*'])
    {
        return $this->repository->firstWhere($where, $columns);
    }

    public function findWhere(array $where, $columns = ['*'])
    {
        return $this->repository->findWhere($where, $columns);
    }

    public function findWherewithTrashed(array $where, $columns = ['*'])
    {
        return $this->repository->findWherewithTrashed($where, $columns);
    }

    public function with($relation)
    {
        return $this->repository->with($relation);
    }

    public function countWhere(array $where)
    {
        return $this->repository->countWhere($where);
    }

    public function updateOrCreate(array $data, array $where)
    {
        return $this->repository->updateOrCreate($data, $where);
    }

    public function updateWhere(array $data, array $where)
    {
        return $this->repository->updateWhere($data, $where);
    }

    public function forceFindById($id, array $columns = ['*'])
    {
        return $this->repository->forceFindById($id, $columns);
    }

    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        return $this->repository->findWhereIn($field, $values, $columns);
    }

    public function findWhereNotIn($field, array $values, $columns = ['*'])
    {
        return $this->repository->findWhereNotIn($field, $values, $columns);
    }

    public function updateWhereIn($field, array $data, array $update)
    {
        return $this->repository->updateWhereIn($field, $data, $update);
    }

    public function findWhereInAndWhere(array $where, $field, array $values, $columns = ['*'])
    {
        return $this->repository->findWhereInAndWhere($where, $field, $values, $columns);
    }
}