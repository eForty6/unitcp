<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;

class Faculty extends Model
{
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'active','fexam'
    ];

    public function Users()
    {
        return $this->hasMany('App\User');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'faculty_id', 'id');
    }

    public function scopeSearch($q,Request $request){
        if ($request->has('id') && !empty($request->id)){
            $q->where('id',$request->id);
        }
        return $q;
    }

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50)
    {
        if (strlen($str) > $maxLength) {
            $excerpt = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt = substr($excerpt, 0, $lastSpace);
            $excerpt .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }


}
