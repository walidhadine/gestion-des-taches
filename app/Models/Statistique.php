<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistique extends Model
{
    use HasFactory;

    protected $table = 'statistiques';

    protected $fillable = [
        'date_jour',
        'total_taches',
        'taches_terminees',
        'taches_en_cours',
        'taches_retard',
        'total_utilisateurs',
        'taux_completion',
        'user_id',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'date_jour' => 'date',
            'total_taches' => 'integer',
            'taches_terminees' => 'integer',
            'taches_en_cours' => 'integer',
            'taches_retard' => 'integer',
            'total_utilisateurs' => 'integer',
            'taux_completion' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

