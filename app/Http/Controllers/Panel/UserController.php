<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\user;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public  function index(){
        return view('panel.users.all');

    }
    public function create()
    {
        return view('panel.users.create');
    }

    public function store(CreateUser $request)
    {
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password = bcrypt($request->password);
        $user->save();
//        $user = User::create($request->all());

        return (isset($user)) ? $this->response_api(true, 'تم إضافة مدير نظام بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return (isset($data['user'])) ? view('panel.users.edit', $data) : redirect()->route(get_current_locale() . '.panel.dashboard');
    }


    public function update($id, CreateUser $request)
    {
        $user = User::updateOrCreate(['id' => $id], $request->all());

        return (isset($user)) ? $this->response_api(true, 'تم تعديل النظام بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }



    public function delete($id)
    {
        $item = user::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'تمت عملية الحذف بنجاح') : $this->response_api(false, 'حدث خطأ غير متوقع');
    }


    public function get_user_data_table(user $items)
    {
         $items = $items ->orderBy('id', 'DESC')->get();
        try {
            return DataTables::of($items)->editColumn('id', function ($item) {
                return $item->id;
            })->editColumn('description', function ($item) {
                return string_limit($item->description,100);
            })->editColumn('created_at', function ($item) {
                return get_date_from_timestamp($item->created_at);
            })->addColumn('action', function ($item) {
                return '<div class="row">
                      <a  title="Edit" style="margin-right: 10px"  href="' . lang_route('panel.users.edit', ['id' => $item->id]) . '"  class="btn btn-sm btn-primary edit" > <i style="margin-left: 3px" class="fa fa-check-square-o"></i> تعديل</a>
                      <a  data-toggle="reject" title="Delete" style="margin-right: 10px;background-color: #FA2A00;color:white"  data-url="' . admin_url('user/delete/' . $item->id) . '"   class="btn btn-sm btn-danger delete">  <i style="margin-left:3px" class="fa  fa-trash-o"></i> حذف </a>
                    </div>';
            })->rawColumns([ 'action'])->make(true);
        } catch (\Exception $e) {
            return $this->response_api(false, 'failed');
        }
    }





}
