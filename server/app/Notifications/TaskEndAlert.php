<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskEndAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }


    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Alert')
            ->from(env('MAIL_FROM_ADDRESS') ?? 'BuildTasks@gmail.com', env('MAIL_FROM_NAME'))
            ->greeting('Task Alert')
            ->line('your Task ' . $this->task->todo . ' is going to end in 30 minutes')
            ->line('Thank you for using our platform');
    }


    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'Alert',
            'username' => $notifiable->name,
            'avatar' => $notifiable->avatar,
            'test' => $this->task->todo,
            'status' => $this->task->isDone
        ];
    }
}
