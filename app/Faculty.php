<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;

class Faculty extends Model
{
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'active'
    ];

    public function albums()
    {
        return $this->hasMany(Department::class, 'faculty_id', 'id');
    }


}
