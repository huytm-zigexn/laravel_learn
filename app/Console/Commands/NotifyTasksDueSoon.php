<?php

namespace App\Console\Commands;

use App\Jobs\SendTaskDueEmail;
use App\Models\Task;
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
    protected $description = 'Check for tasks due in the next 5 minutes and queue email notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $fiveMinutesFromNow = Carbon::now()->addMinutes(5);

        // Find tasks with due dates in the next 5 minutes
        $upcomingTasks = Task::where(function ($query) use ($now, $fiveMinutesFromNow) {
            $query->where('due_date', '>=', $now)->where('due_date', '<=', $fiveMinutesFromNow);
        })
        ->get();

        $this->info("Found {$upcomingTasks->count()} tasks due in the next 5 minutes");

        foreach ($upcomingTasks as $task) {
            // Dispatch a job to send email for each task
            SendTaskDueEmail::dispatch($task);
        }

        return 0;
    }
}
