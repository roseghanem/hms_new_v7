@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/visits") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
    <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" > المريض</label>
           <select name="out_patient_id" class="form-control select2" required>
           </select>

        </div>
     </div>

     <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" > الدكتور</label>
           <select name="doctor_id" class="form-control select2" required>
          </select>
        </div>
     </div>

   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" > العيادة</label>
         <select name="clinic_id" class="form-control select2" required>
        </select>
      </div>
   </div>
   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >التشخيص</label>
         <select name="disease_id" class="form-control select2" required>
        </select>
      </div>
   </div>


   {{ bs_input("patient_history","   القصة المرضية ",'',true) }}
 {{ bs_input("medical_history","  السوابق المرضية ",'',true) }}
 {{ bs_input("surgical_history","  السوابق الجراحية ",'',true) }}
 {{ bs_input("family_history","  السوابق العائلية ",'',true) }}
 {{ bs_input("allergic_history","  السوابق التحسيسة ",'',true) }}
 {{ bs_input("habits"," العادات  ",'',true) }}

   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >التاريخ</label>
         <input type="date" name="date" class="form-control" required>

      </div>
   </div>
   <div class="form-group row mt-2">

    {{ bs_save("حفظ") }}
   </div>

</form>
@endsection

@section('scripts')

<script>

</script>

@endsection


@section('assets')

<script src="{{ url('/select2/select2.full.min.js')}}"></script>
<script src="{{ url('/js/file-input-form-func.js')}}"></script>
<script>
   $('.select2').select2();
   initSelect2($('select[name="clinic_id"]'), "/clinics/select")
   initSelect2($('select[name="doctor_id"]'), "/doctors/select")
   initSelect2($('select[name="out_patient_id"]'), "/out_patients/select")
   //initSelect2($('select[name="out_patient_id"]'), "/patients/select")
   initSelect2($('select[name="disease_id"]'), "/diseases/select")
   //initSelect2($('select[name="scan_req_id"]'), "/scan_requests/select")
</script>
@endsection
