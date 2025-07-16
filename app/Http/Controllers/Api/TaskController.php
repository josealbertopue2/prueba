<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\Response;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{


    /**
     * @param TaskService $service
     */
    public function __construct(protected TaskService $service) {}

    /**
     * GET /api/tareas
     * @return mixed
     */
    public function index()
    {
        $perPage = request()->query('per_page', 10);
        $paginated = $this->service->list((int)$perPage);

        return response()->json($paginated);
    }

    /**
     * POST /api/tareas
     * @param StoreTaskRequest $request
     * @return mixed
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->service->create($request->validated());
        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * PUT /api/tareas/{tarea}
     * @param UpdateTaskRequest $request
     * @param int $task
     * @return mixed
     */
    public function update(UpdateTaskRequest $request, int $task)
    {
        $updated = $this->service->update($task, $request->validated());
        if (!$updated) {
            return response()->json(['message' => 'Tarea no encontrada'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($updated);
    }

    /**
     * DELETE /api/tareas/{tarea}
     * @param int $task
     * @return mixed
     */
    public function destroy(int $task)
    {
        $deleted = $this->service->delete($task);
        if (!$deleted) {
            return response()->json(['message' => 'Tarea no encontrada'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
