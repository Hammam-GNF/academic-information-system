<?php

namespace App\Support\Contracts;

interface BaseRepositoryInterface
{
    public function all(array $columns = ['*']);

    public function paginate(
        int $perPage = 15,
        array $columns = ['*']
    );

    public function find(int|string $id);

    public function findOrFail(int|string $id);

    public function create(array $data);

    public function update(int|string $id, array $data);

    public function delete(int|string $id): bool;
}
