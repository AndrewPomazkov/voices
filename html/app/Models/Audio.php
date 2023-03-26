<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Audio extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'filename', 'created_at', 'user_id'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function audioEffects(): BelongsToMany
    {
        return $this->belongsToMany(Effect::class, 'audio_effects', 'audio_id', 'effect_id')
            ->withPivot('filters')
            ->withTimestamps();
    }

    public function images(): HasMany
    {
        return $this->hasMany(AudioImages::class, 'audio_id');
    }

    public function getPathAttribute(): string
    {
        return str_replace('public/', 'storage/', $this->attributes['path']);
    }
}
