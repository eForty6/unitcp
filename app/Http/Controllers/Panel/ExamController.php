<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CreateExam;
use App\Material;
use App\Faculty;
use App\classes;
use App\Exam;
use App\Year;
use Validator;
use DB;
use Auth;

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


    public function store(CreateExam $request)
    {

        $exam = Exam::create($request->all());
        return (isset($exam)) ? $this->response_api(true, 'تم الأضافة بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }


    public function getData($id) {

        $classes = classes::where("faculty_id",$id)->get();
        $department = DB::table("departments")->where("faculty_id",$id)->get();
        $classes = DB::table("classes")->where("faculty_id",$id)->get();
        $materials = DB::table("materials")->where("faculty_id",$id)->get();
        $semesters = DB::table("semesters")->where("faculty_id",$id)->get();

        $data = ["classes"=>$classes,"department"=>$department,"materials"=>$materials,"semesters"=>$semesters];

        $view =view('panel.material.fac-selectors', $data)->render();

        return response()->json(['status'=>true,'item'=>$view]);
    }

    public function viewall(){

    }
}
