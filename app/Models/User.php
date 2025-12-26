<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'email',
        'password',
        'nom',
        'prenom',
        'is_active',
        'last_login',
        'token_reset',
        'token_expiration',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token_reset',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login' => 'datetime',
            'token_expiration' => 'datetime',
        ];
    }

    // Relations
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function tasksAssigned()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'created_by');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function taskComments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function taskHistory()
    {
        return $this->hasMany(TaskHistory::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_members');
    }

    public function conversationMessages()
    {
        return $this->hasMany(ConversationMessage::class, 'sender_id');
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class, 'uploaded_by');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'generated_by');
    }

    public function preferences()
    {
        return $this->hasMany(UserPreference::class);
    }

    // Helpers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
}
