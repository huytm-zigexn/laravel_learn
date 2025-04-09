<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDueSoonNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyTasksDueSoon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:notify-tasks-due-soon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about tasks due in the next 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::with('users')
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [Carbon::now(), Carbon::now()->copy()->addMinutes(5)])
            ->get();

        foreach ($tasks as $task) {
            foreach ($task->users as $user) {
                $user->notify(new TaskDueSoonNotification($task)); // queued notification
            }
        }

        $this->info('Notifications sent for tasks due soon.');
    }
}
