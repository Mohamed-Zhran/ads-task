<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    public function __construct(protected Model $model)
    {
    }

    public function findAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int $id): int
    {
        return $this->model->destroy($id);
    }
}
