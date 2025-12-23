<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    use HasFactory;

    protected $table = 'task_history';

    protected $fillable = [
        'task_id',
        'user_id',
        'action',
        'ancienne_valeur',
        'nouvelle_valeur',
    ];

    protected function casts(): array
    {
        return [
            'date_action' => 'datetime',
        ];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

