<?php

namespace App\Actions;

use App\Models\Task;

class ToggleStatus
{

    public function execute($task)
    {
            if ($task->status == 0) {
                $task->update([
                    'status' => '1'
                ]);
            } else {
                $task->update([
                    'status' => '0'
                ]);
            }
        return responseJson(200, 'Task status updated successfully',$task);
    }

}
