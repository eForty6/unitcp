<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
         'id','name_ar','name_en','faculty_id'
    ];
}
