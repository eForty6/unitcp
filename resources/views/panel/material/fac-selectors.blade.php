{{--@php--}}
                {{--$class_items = get_classes_data();--}}
                   {{--$dep_items=get_department_data();--}}
                   {{--$semseter_items=get_semester_data();--}}
$data = ["classes"=>$classes,"department"=>$department,"materials"=>$material,
"year" => $year];

{{--@endphp--}}

<fieldset class="form-group">
    <label>اسم الفرقه </label>
    <select class="form-control" name="classes" data-placeholder="إختيار الكليه" required>
        <option disabled selected hidden>اختيار الفرقه</option>
        @if(isset($classes) && $items->count() > 0)
            @foreach($classes as $item)
                {{$classes}}

                <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
            @endforeach
        @endif
    </select>
</fieldset>


<fieldset class="form-group">
    <label>اسم القسم </label>
    <select class="form-control"  name="department" data-placeholder="إختيار الكليه" required>
        <option disabled selected hidden>إختيار الكليه</option>
        @if(isset($department) && $items->count() > 0)
            @foreach($department as $item)
                {{$department}}
                <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
            @endforeach
        @endif
    </select>
</fieldset>


<fieldset class="form-group">
    <label>اسم الترم </label>
    <select class="form-control"  name="semester" data-placeholder="إختيار الترم" required>
        <option disabled selected hidden>إختيار الترم</option>
        @if(isset( $semesters) && $items->count() > 0)
            @foreach($semesters as $item)
                {{$semesters}}
                <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
            @endforeach
        @endif
    </select>
</fieldset>

