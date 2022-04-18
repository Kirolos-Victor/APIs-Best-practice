<?php

namespace App\Actions;

use App\Models\Task;
use Carbon\Carbon;

class UpdateTask
{
    public function execute($request,$task)
    {
        $request->merge(['updated_at' => Carbon::now()->timezone(Auth()->user()->timezone)->toDateTimeString()
        ]);
        $task->update($request->all());
        if ($request->has('status')) {
            $task->update([
                'status' => $request->status
            ]);
        }
        return responseJson(200, 'updated successfully', $task);
    }

}
