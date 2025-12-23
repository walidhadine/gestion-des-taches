<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'cle',
        'valeur',
        'type',
        'description',
    ];

    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('cle', $key)->first();
        if (!$setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => (bool) $setting->valeur,
            'integer' => (int) $setting->valeur,
            'json' => json_decode($setting->valeur, true),
            default => $setting->valeur,
        };
    }

    public static function setValue(string $key, $value, string $type = 'string'): void
    {
        self::updateOrCreate(
            ['cle' => $key],
            [
                'valeur' => is_array($value) ? json_encode($value) : $value,
                'type' => $type,
            ]
        );
    }
}

