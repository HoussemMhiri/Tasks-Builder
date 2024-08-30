<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ["todo", "isDone", "end_before", "user_id"];

    protected $casts = [
        'isDone' => 'boolean',
        'end_before' => 'datetime:Y-m-d H:i',
    ];


    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
