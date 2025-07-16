<?php

namespace App\Services;

use App\Repositories\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Task;

class TaskService
{
    /**
     * @param TaskRepositoryInterface $repo
     */
    public function __construct(
        protected TaskRepositoryInterface $repo
    ) {}

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repo->paginate($perPage);
    }

    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return $this->repo->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Task|null
     */
    public function update(int $id, array $data): ?Task
    {
        $task = $this->repo->find($id);
        if (!$task) {
            return null;
        }
        return $this->repo->update($task, $data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $task = $this->repo->find($id);
        if (!$task) {
            return false;
        }
        $this->repo->delete($task);
        return true;
    }
}
