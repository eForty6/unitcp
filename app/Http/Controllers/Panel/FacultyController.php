<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\faculty;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CreateFaculty;
class FacultyController extends Controller
{
    public  function index(){
        return view('panel.faculty.all');

    }
    public function create()
    {
        return view('panel.faculty.create');
    }

    public function store(CreateFaculty $request)
    {

        $faculty = Faculty::create($request->all());

        return (isset($faculty)) ? $this->response_api(true, 'تم إضافة كليه بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }

    public function edit($id)
    {
        $data['faculty'] = Faculty::find($id);
        return (isset($data['faculty'])) ? view('panel.faculty.edit', $data) : redirect()->route(get_current_locale() . '.panel.dashboard');
    }


    public function update($id, CreateFaculty $request)
    {
        $faculty = Faculty::updateOrCreate(['id' => $id], $request->all());

        return (isset($faculty)) ? $this->response_api(true, 'تم تعديل بيانات الكليه بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }



    public function delete($id)
    {
        $item = faculty::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'تمت عملية الحذف بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }


//    public function get_fac_data_table(faculty $items)
//    {
//        $items = $items ->orderBy('id', 'ASC')->get();
//
//        try {
//            return DataTables::of($items)->editColumn('id', function ($item) {
//                return $item->id;
//
//            })->addColumn('action', function ($item) {
//                return '<div class="row">
//                      <a  title="Edit" style="margin-right: 10px"  href="' . lang_route('panel.faculty.edit', ['id' => $item->id]) . '"  class="btn btn-sm btn-primary edit" > <i style="margin-left: 3px" class="fa fa-check-square-o"></i> تعديل</a>
//                      <a  data-toggle="reject" title="Delete" style="margin-right: 10px;background-color: #FA2A00;color:white"  data-url="' . admin_url('faculty/delete/' . $item->id) . '"   class="btn btn-sm btn-danger delete">  <i style="margin-left:3px" class="fa  fa-trash-o"></i> حذف </a>
//                    </div>';
//            })->rawColumns([ 'action'])->make(true);
//        } catch (\Exception $e) {
//            return $this->response_api(false, 'failed');
//        }
//    }



    public function get_faculty_data($id)
    {
        $item = Faculty::find($id);
        return (isset($item)) ? $this->response_api(true, 'success', $item) : $this->response_api(false, 'success');
    }

    public function get_fac_data_table(faculty $items)
    {
        $items = $items ->orderBy('id', 'ASC')->get();


        try {
            return DataTables::of($items)->editColumn('id', function ($item) {
                return $item->id;

            })->addColumn('action', function ($item) {
                return '<div class="row">
                      <button title="Edit" style="margin-right: 10px" data-id="' . $item->id . '" data-toggle="modal" data-target="#edit_modal"  class="btn btn-sm btn-primary edit" > <i style="margin-left: 3px" class="fa fa-check-square-o"></i> تعديل</button>

                      <a  data-toggle="reject" title="Delete" style="margin-right: 10px;background-color: #FA2A00;color:white"  data-url="' . admin_url('faculty/delete/' . $item->id) . '"   class="btn btn-sm btn-danger delete">  <i style="margin-left:3px" class="fa  fa-trash-o"></i> حذف </a>
                    </div>';
            })->rawColumns([ 'action'])->make(true);
        } catch (\Exception $e) {
            return $this->response_api(false, 'failed');
        }
    }

}
