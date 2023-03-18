<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioEffect extends Model
{
    use HasFactory;

    public function audio()
    {
        return $this->belongsTo(Audio::class);
    }
}
