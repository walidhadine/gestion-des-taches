<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'avatar',
        'telephone',
        'poste',
        'departement',
        'bureau',
        'notifications_email',
        'notifications_app',
        'theme',
        'langue',
        'signature',
        'bio',
    ];

    protected function casts(): array
    {
        return [
            'notifications_email' => 'boolean',
            'notifications_app' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

