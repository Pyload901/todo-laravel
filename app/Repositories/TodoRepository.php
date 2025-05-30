<?php
namespace App\Repositories;
use App\Models\Todo;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Support\Collection;

class TodoRepository implements TodoRepositoryInterface {
    public function create(array $data): Todo {
        return Todo::create($data);
    }
    public function getAll(): Collection {
        return Todo::all();
    }
    public function getById(int $id): ?Todo {
        return Todo::findOrFail($id);
    }
    public function update(int $id, array $data):bool {
        $todo = Todo::findOrFail($id);
        return $todo->update($data);
    }
    public function delete(int $id):bool {
        return Todo::destroy($id);
    }
}