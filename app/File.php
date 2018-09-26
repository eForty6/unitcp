<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'display_name', 'file_name', 'mime_type', 'size'
    ];

    public static $rules = [
        'file' => 'required|mimes:doc,pdf,docx,zip'
    ];

    public static $messages = [
        'file.mimes' => 'الملف الذي تحاول رفعه له صيغة غير مدعومة',
        'file.required' => 'الملف مطلوب'
    ];
}