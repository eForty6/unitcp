@php
    $breadcrumb_array = [];
    array_push($breadcrumb_array,collect(['is_last'=>true,'name'=>'اضافه امتحان ','link'=> '#']));
    array_push($breadcrumb_array,collect(['is_last'=>false,'name'=>'مستودع الامتحانات','link'=> lang_route('panel.material.all')]));
@endphp
@extends('panel.layouts.index',['sub_title'=>'مستودع الامتحانات' ,'breadcrumb_array'=> $breadcrumb_array])

@section('main')
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
    @push('panel_css')
        {!! HTML::style('panel/css/jasny-bootstrap.min.css') !!}
        {!! HTML::style('panel/plugins/summernote/summernote-bs4.css') !!}
    @endpush

    <div class="content">
        {!! Form::open(['id'=>'form','method'=>'POST','url'=>route('panel.material.create'),'to'=>route('panel.material.all')]) !!}
        <div class="row">
            <div class="col-md-8">
                {{--<input type="hidden" id="photo" name="image" value="{{$post->image}}">--}}
                <div class="card">
                    <div class="card-body">

                        @php
                            $items = get_fac_data();

                        @endphp

                        <fieldset class="form-group">
                            <label>اسم الكليه </label>
                            <select class="form-control faculty" select name="faculty_id" data-placeholder="إختيار الكليه" required>
                                <option disabled selected hidden>إختيار الكليه</option>
                                @if(isset($items) && $items->count() > 0)
                                    @foreach($items as $item)

                                        <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </fieldset>


                        <div id="selectors_div">
                            @include('panel.material.fac-selectors')
                        </div>


                        <input type="hidden" id="exam_file_name" name="fexam">
                        <div id="fileuploader" class="hidden">Upload</div>





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

        {{--</script>--}}
        <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
        <script>
            $(document).ready(function()
            {
                $(document).on('change','.faculty',function () {
                    var cid = $('.faculty option:selected').val();
                    if(cid  > 0)
                    {

                        $('#fileuploader').removeClass('hidden');

                        $("#fileuploader").uploadFile({
                            url:"{{url('admin/file/upload')}}",
                            multiple:false,
                            dragDrop:false,
                            formData: { _token: '{{csrf_token()}}',facid:cid },
                            maxFileCount:1,
                            fileName:"file",
                            onSuccess:function(files,data,xhr,pd)
                            {
                                $('#exam_file_name').val(data.file_name);
                            }
                        });
                    }
                });
            });
        </script>



        {!! HTML::script('panel/js/jasny-bootstrap.min.js') !!}
        {!! HTML::script('panel/js/jasny.js') !!}
        {!! HTML::script('panel/plugins/summernote/summernote-bs4.js') !!}
        {!! HTML::script('/panel/js/post.js') !!}

    @endpush
@stop