<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable=[
        'faculty_id','department_id','class_id','semester_id','year_id','fexam','views_num'

    ];

    public function class()
    {
        return $this->belongsTo(classes::class, 'classes_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(semester::class, 'semester_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(material::class, 'material_id');
    }

    public function year()
    {
        return $this->belongsTo(year::class, 'year_id', 'id');
    }

    public function hasYear()
    {
        return (isset($this->year->name));
    }

    public function hasSemester()
    {
        return (isset($this->semester));
    }

    public function hasMaterial()
    {
        return (isset($this->material));
    }

    public function hasClass()
    {
        return (isset($this->class));
    }

    public function getClassName()
    {
        return ($this->hasClass()) ? $this->class->name_en : '';
    }

    public function getMateriaName()
    {

        return ($this->hasMaterial()) ? $this->material->name_en : '';
    }

    public function getSemesterName()
    {
        return ($this->hasSemester()) ? $this->semester->name_en : '';
    }

    public function getYearName()
    {
        return ($this->hasYear()) ? $this->year->name : '';
    }

    public function getFullName()
    {
        return $this->getClassName() . ' ' . $this->getSemesterName() . ' ' . $this->getMateriaName() . ' ' . $this->getYearName();
    }


    public function scopeSearch($q, Request $request)
    {
        if ($request->has('faculty_id') && !empty($request->faculty_id)) {
            $q->where('faculty_id', $request->faculty_id);
        }
        return $q;

    }

}
