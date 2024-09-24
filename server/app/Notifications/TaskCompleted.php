<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Update')
            ->from(env('MAIL_FROM_ADDRESS') ?? 'BuildTasks@gmail.com', env('MAIL_FROM_NAME'))
            ->greeting('Task Update')
            ->line('Congratulations ' . $notifiable->name  .  ' your Task ' . $this->task->todo . ' is Completed')
            ->line('Thank you for using our platform');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'username' => $notifiable->name,
            'email' => $notifiable->email,
            'avatar' => $notifiable->avatar,
            'test' => $this->task->todo,
            'status' => $this->task->isDone
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'username' => $notifiable->name,
            'email' => $notifiable->email,
            'avatar' => $notifiable->avatar,
            'test' => $this->task->todo,
            'status' => $this->task->isDone
        ]);
    }
}
