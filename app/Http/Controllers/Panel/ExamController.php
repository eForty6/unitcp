<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function index(){

        return view('panel.exam.main');


    }
    public function create(){

    }

    public function viewall(){

}
}
