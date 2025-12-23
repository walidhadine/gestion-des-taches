<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'status',
        'priority',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'created_by',
        'assigned_to',
        'category_id',
        'is_important',
        'completion_percentage',
        'notes',
        'fichier_joint',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
            'date_fin' => 'date',
            'is_important' => 'boolean',
            'completion_percentage' => 'integer',
            'date_creation' => 'datetime',
            'date_modification' => 'datetime',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function history()
    {
        return $this->hasMany(TaskHistory::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }

    public function isOverdue(): bool
    {
        return $this->date_fin && $this->date_fin < now() && $this->status !== 'terminé';
    }

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->date_fin) {
            return null;
        }
        return now()->diffInDays($this->date_fin, false);
    }
}

