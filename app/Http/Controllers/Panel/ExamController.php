<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClasses;
use Yajra\DataTables\DataTables;
use App\classes;
use App\faculty;
use App\Exam;

class ExamController extends Controller
{
    public function index(){
        return view('panel.exam.main');
    }

    public function main(){
        return view('panel.exam.main');

    }

    public function create(){
        return view('panel.exam.create');
    }

    public function viewall(){

}
}
