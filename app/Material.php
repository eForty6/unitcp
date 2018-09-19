<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
         'id','name_ar','name_en','faculty_id','class_id','department_id','semester_id'
    ];
}
