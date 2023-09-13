<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface{

    public function __construct(
        protected Support $model
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->model
                    ->when($filter, function($query) use($filter){
                        $query->where('subject', $filter)
                              ->orWhere('body', 'like', "%{$filter}%");
                    })
                    ->get()
                    ->toArray();
    }
    public function findOne(string $id): stdClass|null
    {
        $support = $this->model->find($id);

        if(!$support){
            return null;
        }

        return (object) $support->toArray();
    }
    public function delete(string $id): void
    {
        $this->model->find($id)->delete();
    }
    public function new(CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create(
            (array) $dto
        );

        return (object) $support->toArray();
    }
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        if(!$support = $this->model->find($dto->id)){
            return null;
        }

        $support->update((array) $dto);

        return (object) $support->toArray();
    }
}
