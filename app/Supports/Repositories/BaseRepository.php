<?php

namespace App\Support\Repositories;

use App\Support\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        protected Model $model
    ) {}

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function paginate(
        int $perPage = 15,
        array $columns = ['*']
    ) {
        return $this->model->paginate($perPage, $columns);
    }

    public function find(int|string $id)
    {
        return $this->model->find($id);
    }

    public function findOrFail(int|string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int|string $id, array $data)
    {
        $model = $this->findOrFail($id);

        $model->update($data);

        return $model->fresh();
    }

    public function delete(int|string $id): bool
    {
        return (bool) $this->findOrFail($id)->delete();
    }
}
