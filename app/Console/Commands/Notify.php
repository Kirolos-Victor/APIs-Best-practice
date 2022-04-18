<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\Models\User;
use App\Notifications\TaskNotify;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email notification about the number of tasks the user completed that day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $lists = $user->lists();
            $numberOfTasksCompleted = 0;
            foreach ($lists as $list) {
                $numberOfTasksCompleted += $list->tasks()->whereDate(
                    'created_at',
                    '=',
                    Carbon::today()->timezone($user->timezone)
                )->where(
                    'status',
                    '=',
                    1
                )->count();
            }


            $user->notify(new TaskNotify($numberOfTasksCompleted));
        }
    }
}
