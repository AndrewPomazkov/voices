<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class AudioUploaderHelper
{
    public static function getExtensionByMimeType(UploadedFile $file)
    {
        switch ($file->getMimeType())
        {

            case 'audio/x-wav':
            case 'audio/wav':
            default:
                return 'wav';

        }
    }
}
