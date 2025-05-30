<?php
namespace App\Repositories\Interfaces;
use App\Models\Todo;
use Illuminate\Support\Collection;
interface TodoRepositoryInterface {
    public function create(array $data);
    public function getAll(): Collection;
    public function getById(int $id):?Todo;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}