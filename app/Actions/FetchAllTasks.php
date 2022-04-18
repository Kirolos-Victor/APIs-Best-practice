<?php

namespace App\Actions;

use App\Models\UserList;
use Carbon\Carbon;

class FetchAllTasks
{

    public function execute($id)
    {
            $tasks = UserList::with('tasks')
                ->whereHas('tasks', function ($query) {
                    $query
                        ->where('status', '=', 1)
                        ->whereDate(
                            'deadline',
                            '>',
                            Carbon::now()->timezone(Auth()->user()->timezone)->toDateTimeString()
                        );
                })
                ->where('id', '=', $id)
                ->get()
                ->pluck('tasks')
                ->collapse();

            if (count($tasks) == 0) {
                return responseJson(404, 'no tasks');
            }

            return responseJson(200, 'success', $tasks);
        }

}
