<?php
namespace App\Services;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;
use Illuminate\Support\Collection;
class TodoService {
    protected TodoRepositoryInterface $todoRepository;
    public function __construct(TodoRepositoryInterface $todoRepository) {
        $this->todoRepository = $todoRepository;
    }

    public function create(array $data) {
        $this->todoRepository->create($data);
    }
    public function getAll(): Collection {
        return $this->todoRepository->getAll();
    }
    public function delete(int $id): bool {
        return $this->todoRepository->delete($id);
    }
    public function update(int $id, array $data): bool {
        return $this->todoRepository->update($id, $data);
    }
}
