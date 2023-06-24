@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/switch_to_clinics") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")






     <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" > رقم الزيارة</label>
           <select name="visit_id" class="form-control select2" required>
          </select>
        </div>
     </div>


   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >العيادة الوجهة</label>
         <select name="clinic_id" class="form-control select2" required>
        </select>
      </div>
   </div>

   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >التاريخ</label>
         <input type="date" name="req_date" class="form-control" required>

      </div>
   </div>

   {{ bs_input("notes"," ملاحظات ",'',true) }}


   <div class="form-group row mt-2">

    {{ bs_save("حفظ") }}
   </div>

</form>
@endsection

@section('assets')

<script src="{{ url('/select2/select2.full.min.js')}}"></script>
<script src="{{ url('/js/file-input-form-func.js')}}"></script>
<script>
   $('.select2').select2();

   initSelect2($('select[name="visit_id"]'), "/visits/select")

   initSelect2($('select[name="clinic_id"]'), "/clinics/select")

</script>
@endsection
