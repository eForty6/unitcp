@php
    $breadcrumb_array = [];
    array_push($breadcrumb_array,collect(['is_last'=>true,'name'=>$user->name,'link'=> '#']));
    array_push($breadcrumb_array,collect(['is_last'=>true,'name'=>'مديرى النظام','link'=> ('panel.users.all')]));
@endphp

@extends('panel.layouts.index',['sub_title'=>'تعديل بيانات ' ,'breadcrumb_array'=> $breadcrumb_array])
@section('main')
    @push('panel_css')
        {!! HTML::style('panel/css/jasny-bootstrap.min.css') !!}
        {!! HTML::style('panel/plugins/summernote/summernote-bs4.css') !!}
    @endpush

    <div class="content">
        {!! Form::open(['id'=>'form','method'=>'PUT','url'=>route('panel.users.edit',['id'=>$user->id]),'to'=>lang_route('panel.users.all')]) !!}

        <div class="row">
            <div class="col-md-8">
                {{--<input type="hidden" id="photo" name="image" value="{{$post->image}}">--}}
                <div class="card">
                    <div class="card-body">
                        <fieldset class="form-group">
                            <label>الأسم</label>
                            <input class="form-control"  type="text" name="name" placeholder="الرجاء إدخال العنوان"  value="{{$user->name}}" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>البريد الألكترونى</label>
                            <input class="form-control"  type="password" name="password" placeholder="الرجاء ادخال كلمه المرور"  value="" >
                        </fieldset>


                        <fieldset class="form-group">
                            <label>البريد الألكترونى</label>
                            <input class="form-control"  type="text" name="email" placeholder="الرجاء ادخال البريد الالكترونى"  value="{{$user->email}}" required>
                        </fieldset>

                        {{--<label >المحتوى</label>--}}
                        {{--<fieldset class="form-group">--}}
                            {{--<textarea  id="summernote" name="text" rows="10">--}}
                                 {{--{{$post->text}}--}}
                            {{--</textarea>--}}
                        {{--</fieldset>--}}
                        {{--@php--}}
                            {{--$items = get_all_post_cats();--}}
                        {{--@endphp--}}

                        <fieldset class="form-group">
                            <label>الحاله</label>
                            <select class="form-control" name="category_id" data-placeholder="إختيار التصنيف" >
                                <option disabled selected hidden>إختيار التصنيف</option>
                                {{--@if(isset($items) && $items->count() > 0)--}}
                                    {{--@foreach($items as $item)--}}
                                        <option value="{{$user->id}}" ></option>
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            </select>
                        </fieldset>


                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 30px">
                    <div class="card-body">
                        <div class="row btn_padding">
                            <button style="width: 90%" class=" btn btn-primary">حفظ&nbsp; &nbsp;
                                <i style="top: inherit;left: AUTO;" class="upload-spinn fa fa-cog fa-spin fa-1x fa-fw  hidden"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {!! Form::close() !!}

    </div>

    @push('top_js')
        {!! HTML::script(asset('/js/app.js')) !!}
    @endpush

    @push('panel_js')

        {!! HTML::script('panel/js/jasny-bootstrap.min.js') !!}
        {!! HTML::script('panel/js/jasny.js') !!}
        {!! HTML::script('panel/plugins/summernote/summernote-bs4.js') !!}
        {!! HTML::script('/panel/js/post.js') !!}

    @endpush
@stop