@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ route('outpatient.store') }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
    <div class="form-group row mt-2 " style="font-size:16px">


        {{ bs_input("first_name","اسم المريض",'',true) }}

        {{ bs_input("father_name","اسم الأب",'',true) }}

        {{ bs_input("last_name","الكنية",'',true) }}

        {{ bs_input("mother_name","اسم الأم",'',true) }}

        {{ bs_input("gender","الجنس",'',true) }}



        {{ bs_input("birth_place","مكان الولادة",'',true) }}


        {{ bs_date("birth_date",'',true) }}

        {{ bs_input("city","المدينة",'',true) }}

        {{ bs_input("code","الكود",'',true) }}

        {{ bs_input("address","العنوان",'',true) }}

        {{ bs_number("hospital_number",'',true) }}

        {{ bs_number("national_number",'',true) }}

        {{ bs_number("identity_number",'',true) }}

        <div class="col-lg-3">
            <label class="col-form-label text-md-left" >زمرة الدم</label>
            <select name="blood_group_id" class="form-control col-lg-3 select2" required></select>
        </div>

     </div>

    {{ bs_save("حفظ") }}

</form>
@endsection



{{--@extends('dashboard.layouts.index')--}}

{{--@section('content')--}}
{{--    <form role="form" action='{{ route('outpatient.store') }}' class="form-horizontal" method="post">--}}
{{--        @csrf--}}
{{--        @method("POST")--}}



{{--        {{ bs_input("name","اسم المريض",'',true) }}--}}
{{--        {{ bs_input("name","اسم الأب",'',true) }}--}}
{{--        {{ bs_input("name","نسبة المريض",'',true) }}--}}
{{--        {{ bs_input("name","اسم الأم",'',true) }}--}}
{{--        {{ bs_input("name","الجنس",'',true) }}--}}
{{--        {{ bs_input("phone","رقم الهاتف",'',true) }}--}}
{{--        {{ bs_save("حفظ") }}--}}
{{--        </div>--}}

{{--    </form>--}}
{{--@endsection--}}

@section('assets')

    <script src="{{ url('/select2/select2.full.min.js')}}"></script>
    <script src="{{ url('/js/file-input-form-func.js')}}"></script>
    <script>
        $('.select2').select2();
        initSelect2($('select[name="patient_id"]'), "/patients/select")
        initSelect2($('select[name="blood_group_id"]'), "/blood_groups/select")

    </script>
@endsection
