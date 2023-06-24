@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ route('out_patients.update',$out_patient->id) }}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
    <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" > تعديل بيانات المريض</label>

            {{ bs_input("first_name","اسم المريض",$out_patient->Patient->first_name,true) }}
            {{ bs_input("father_name","اسم الأب",$out_patient->Patient->father_name,true) }}
            {{ bs_input("last_name","الكنية",$out_patient->Patient->last_name,true) }}
            {{ bs_input("mother_name","اسم الأم",$out_patient->Patient->mother_name,true) }}
            <div class="form-group row mt-2">
                <div class="col-sm-12">
                    <label class="col-form-label text-md-left" >زمرة الدم</label>
                    <select name="blood_group_id" class="form-control select2" required>

                        <option value="{{ $out_patient->blood_group_id }}" selected>
                            {{ $out_patient->BloodGroup->name }}
                        </option>

                    </select>

                </div>
            </div>

            {{ bs_input("birth_place","مكان الولادة",$out_patient->Patient->birth_place,true) }}

            {{ bs_input("gender","الجنس",$out_patient->Patient->gender,true) }}

            {{ bs_date("birth_date",$out_patient->Patient->birth_date,true) }}

            {{ bs_input("city","المدينة",$out_patient->Patient->city,true) }}

            {{ bs_input("code","الكود",$out_patient->Patient->code,true) }}

            {{ bs_input("address","العنوان",$out_patient->Patient->address,true) }}

            {{ bs_number("hospital_number",$out_patient->Patient->hospital_number,true) }}

            {{ bs_number("national_number",$out_patient->Patient->national_number,true) }}

            {{ bs_number("identity_number",$out_patient->Patient->identity_number,true) }}




        </div>
     </div>



    {{ bs_save("تعديل") }}

</form>
@endsection

@section('assets')

<script src="{{ url('/select2/select2.full.min.js')}}"></script>
<script src="{{ url('/js/file-input-form-func.js')}}"></script>
<script>
   $('.select2').select2();
   initSelect2($('select[name="blood_group_id"]'), "/blood_groups/select")
   initSelect2($('select[name="patient_id"]'), "/patients/select")
</script>
@endsection
