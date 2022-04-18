<?php

namespace App\Http\Controllers\API;

use App\Actions\CheckTimezone;
use App\Actions\FetchAllTasks;
use App\Actions\ToggleStatus;
use App\Actions\UpdateTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(FetchAllTasks $fetchAllTasks, CheckTimezone $checkTimezone, IndexTaskRequest $request)
    {
        $checkTimezone->execute($request);
        return $fetchAllTasks->execute($request->user_lists_id);
    }

    public function store(StoreTaskRequest $request)
    {

        $data = Task::create($request->all());
        return responseJson(200, 'success', $data);
    }

    public function update(UpdateTask $updateTask, EditTaskRequest $request, Task $task)
    {

        return $updateTask->execute($request, $task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return responseJson(200, 'deleted successfully');
    }

    public function updateStatus(ToggleStatus $toggleStatus, Task $task)
    {
        return $toggleStatus->execute($task);
    }


}
