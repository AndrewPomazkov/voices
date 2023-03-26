<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AudioImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'views',
        'likes',
        'dislikes',
    ];

    protected $primaryKey = 'id';

    public function audio(): HasMany
    {
        return $this->hasMany(Audio::class, 'audio_id');
    }
}
