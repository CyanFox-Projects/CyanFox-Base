<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'is_locked',
    ];

    protected function casts(): array
    {
        return [
            'is_locked' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($setting) {
            if ($setting->isDirty('is_locked')) {
                return true;
            }
            if ($setting->isDirty('value') && $setting->is_locked) {
                Log::debug('Attempted to update locked setting: '.$setting->key);

                return false;
            }

            return true;
        });
    }
}
