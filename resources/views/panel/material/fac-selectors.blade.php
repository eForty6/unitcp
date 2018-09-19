{{--@php--}}
                {{--$class_items = get_classes_data();--}}
                   {{--$dep_items=get_department_data();--}}
                   {{--$semseter_items=get_semester_data();--}}


{{--@endphp--}}

<fieldset class="form-group">
    <label>اسم الفرقه </label>
    <select class="form-control" select name="class_id" data-placeholder="إختيار الكليه" required>
        <option disabled selected hidden>اختيار الفرقه</option>
        @if(isset($classes) && $classes->count() > 0)
            @foreach($classes as $item)
                {{$classes}}

                <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
            @endforeach
        @endif
    </select>
</fieldset>


<fieldset class="form-group">
    <label>اسم القسم </label>
    <select class="form-control"  name="department_id" data-placeholder="إختيار الكليه" required>
        <option disabled selected hidden>إختيار القسم</option>
        @if(isset($department) && $department->count() > 0)
            @foreach($department as $item)
                {{$department}}
                <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
            @endforeach
        @endif
    </select>
</fieldset>


<fieldset class="form-group">
    <label>اسم الترم </label>
    <select class="form-control" select name="semester_id" data-placeholder="إختيار الكليه" required>
        <option disabled selected hidden>إختيار الترم</option>
        @if(isset( $semesters) && $semesters->count() > 0)
            @foreach($semesters as $item)
                {{$semesters}}
                <option value="{{$item->id}}" >{{get_text_locale($item,'name_ar')}}</option>
            @endforeach
        @endif
    </select>
</fieldset>

