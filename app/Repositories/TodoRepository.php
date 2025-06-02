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
        return auth()->user()->todos()->orderBy('created_at', 'desc')->get();
    }
    
    public function getById(int $id): ?Todo {
        return auth()->user()->todos()->findOrFail($id);
    }
    
    public function update(int $id, array $data):bool {
        $todo = auth()->user()->todos()->findOrFail($id);
        return $todo->update($data);
    }
    
    public function delete(int $id):bool {
        $todo = auth()->user()->todos()->findOrFail($id);
        return $todo->delete();
    }
}