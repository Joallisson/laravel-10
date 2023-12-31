<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    protected $repository;

    public function __construct(
        protected SupportRepositoryInterface $request
    )
    {
    }

    public function getAll(string $filter = null): array
    {
        return (array) $this->request->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->request->findOne($id);
    }

    public function new(CreateSupportDTO $dto): stdClass {
        return $this->request->new($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null {
        return $this->request->update($dto);
    }

    public function delete(string $id): void
    {
        $this->request->delete($id);
    }
}
