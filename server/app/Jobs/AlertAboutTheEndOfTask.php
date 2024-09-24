<?php

namespace App\Jobs;

use App\Models\Task;
use App\Notifications\TaskEndAlert;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AlertAboutTheEndOfTask implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Job started: AlertAboutTheEndOfTask');

        try {
            $now = Carbon::now('Africa/Tunis');
            $endAt = $now->addMinutes(30)->startOfMinute();
            Log::info('End At: ' . $endAt->toDateTimeString());


            $tasksEndBefore30Minutes = Task::where('end_before', $endAt)->get();
            Log::info('Fetched tasks count: ' . $tasksEndBefore30Minutes->count());

            foreach ($tasksEndBefore30Minutes as $task) {
                Log::info('Processing Task ID: ' . $task->id);

                $creator = $task->creator;

                if ($creator && $task->isDone == 0) {
                    try {

                        $creator->notify(new TaskEndAlert($task));
                        Log::info('Notification sent to: ' . $creator->email);
                    } catch (\Exception $e) {
                        Log::error('Notification error for Task ID ' . $task->id . ': ' . $e->getMessage());
                    }
                } else {
                    Log::warning('No creator found for Task ID ' . $task->id);
                }
            }

            Log::info('Job completed successfully.');
        } catch (\Throwable $e) {
            Log::error('Error in AlertAboutTheEndOfTask: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
