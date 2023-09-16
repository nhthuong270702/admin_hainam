<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->orderBy('id', 'desc')->paginate(10);
    }

    public function find($id)
    {
        return $this->repository->findOrFail($id);
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($user, $data)
    {
        return $this->repository->update($user, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
