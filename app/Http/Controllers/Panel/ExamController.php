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



//    public function uploads(request $request,$id){
//
//
//    $file = $request->file('file');
//    $fileName = time().$file->getClientOriginalName();
////        $path = storage_path('app/uploads/images/'.$file->filename);
//    $file = request()->file('file')->store('faculty/exams/'.request('facid'));
//    $upload_success = $file->move(storage_path('faculty/exams/'.request('facid')),$file);
//
//    if ($upload_success) {
//        return response()->json($upload_success, 200);
//    }
//    // Else, return error 400
//    else {
//        return response()->json('error', 400);
//    }
//
//
//}

    public function store(CreateExam $request)
    {
        //dd($request->all());
		//dd(\App\File::$rules);
		$validator = Validator::make(
		$request->all(),
		\App\File::$rules,
		\App\File::$messages);
        if ($validator->fails()) {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
            ], 400);
        }
//        TODO :: File its an object of request

        $fileRequeste = $request->file('file');
        $file_size = $fileRequeste->getClientSize();
        $extension = $fileRequeste->getClientOriginalExtension();
        $allowed_filename = 'file_'.time().mt_rand().'.'.$extension;	
		
        $fileStatus = $fileRequeste->storeAs('faculty/exams/'.request('facid'),$allowed_filename);
		
        $originalName = str_replace('.'.$extension, '', $fileRequeste->getClientOriginalName());
		
        if( !$fileStatus ) {
            return Response::json([
                'error' => true,
                'message' => 'حدثت مشكلة في الخادم أثناء رفع الملفات',
            ], 500);
        }
        $fileModule = new \App\File;
        $fileModule->display_name = $originalName.'.'.$extension;
        $fileModule->file_name = $allowed_filename;
        $fileModule->mime_type = $extension;
        $fileModule->size = $file_size;
        $fileModule->save();
		
		//Save Exam
	
		$exam = new Exam;
		$exam->faculty_id 		= $request->get('faculty');
		$exam->class_id 		= $request->get('class_id');
		$exam->department_id 	= $request->get('department_id');
		$exam->semester_id 		= $request->get('semester_id');
		$exam->year_id 			= $request->get('year_id');
		$exam->file 			= $fileModule->file_name;
		$exam->save();
		
		
        //$exam = Exam::create($request->all());
        return (isset($exam)) ? $this->response_api(true, 'تم الأضافة بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }




    public function getExamData($id) {

        $classes = classes::where("faculty_id",$id)->get();
        $department = DB::table("departments")->where("faculty_id",$id)->get();
        $classes = DB::table("classes")->where("faculty_id",$id)->get();
        $materials = DB::table("materials")->where("faculty_id",$id)->get();
        $semesters = DB::table("semesters")->where("faculty_id",$id)->get();
        $year = DB::table("years")->get();

        $data = ["classes"=>$classes,"department"=>$department,"materials"=>$materials,"semesters"=>$semesters,"year"=>$year];

        $view =view('panel.exam.exam-selectors', $data)->render();

        return response()->json(['status'=>true,'item'=>$view]);
    }

    public function viewall(){

    }
}
