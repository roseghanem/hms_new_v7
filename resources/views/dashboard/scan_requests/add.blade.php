@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/scan_requests") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")




    <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" >طلب الاشعة</label>

           <select name="scan_unit_id" class="form-control select2" required>
           </select>

        </div>
     </div>

     <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" > كود الزيارة</label>
           <select name="visit_id" class="form-control select2" required>
          </select>
        </div>
     </div>


   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >العضو المراد تصويره</label>
         <select name="part_of_body_id" class="form-control select2" required>
        </select>
      </div>
   </div>

   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >التاريخ</label>
         <input type="date" name="req_date" class="form-control" required>

      </div>
   </div>
   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >الحمل</label>
         <input type="checkbox" name="pregnant_woman">
      </div>
   </div>
   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >تم تحضير المريض</label>
         <input type="checkbox" name="patient_preparation"   >
      </div>
   </div>
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

   initSelect2($('select[name="scan_unit_id"]'), "/scan_units/select")
   initSelect2($('select[name="part_of_body_id"]'), "/body_parts/select")

</script>
@endsection
