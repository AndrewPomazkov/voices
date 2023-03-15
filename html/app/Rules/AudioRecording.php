<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AudioRecording implements Rule
{
    public function passes($attribute, $value)
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($value);
        return in_array($mime, ['audio/wav', 'audio/mpeg', 'text/plain']);
    }

    public function message()
    {
        return 'The :attribute must be a valid audio recording in WAV or MP3 format.';
    }
}
