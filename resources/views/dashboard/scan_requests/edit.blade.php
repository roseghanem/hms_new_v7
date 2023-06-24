@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/scan_requests/update/'.$scan_request->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >الوصفة الطبية</label>

            <select name="scan_unit_id" class="form-control select2" required>
               <option value="{{$scan_request->scan_unit_id}}" selected>
                  {{$scan_request->scanUnit->name}}
               </option>
            </select>

         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > الزيارة </label>
            <select name="visit_id" class="form-control select2" required>
               <option value="{{$scan_request->visit_id}}" selected>
                  {{$scan_request->visit_id}}
               </option>
         </select>
         </div>
      </div>


      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >العضو المراد تصويره</label>
            <select name="part_of_body_id" class="form-control select2" required>
               <option value="{{$scan_request->part_of_body_id}}" selected>
                  {{$scan_request->partOfBody->name}}
               </option>
            </select>
         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >التاريخ</label>
            <input type="date"  value="{{$scan_request->date}}" name="req_date" class="form-control" >

         </div>
      </div>
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >الحمل</label>
            <input type="checkbox" @if ($scan_request->pregnant_woman) checked @endif name="pregnant_woman">
         </div>
      </div>
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >تم تحضير المريض</label>
            <input type="checkbox" @if ($scan_request->patient_preparation) checked @endif name="patient_preparation"   >
         </div>
      </div>
   <div class="form-group row mt-2">

    {{ bs_save("تعديل") }}
   </div>

</form>
@endsection

@section('assets')

<script src="{{ url('/select2/select2.full.min.js')}}"></script>
<script src="{{ url('/js/file-input-form-func.js')}}"></script>
<script>
   $('.select2').select2();

   initSelect2($('select[name="visit_id"]'), "/visits/select")
   initSelect2($('select[name="drug_form_id"]'), "/drug_forms/select")

</script>
@endsection
