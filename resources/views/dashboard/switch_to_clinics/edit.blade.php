@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/switch_to_clinics/update/'.$switch_to_clinic->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >طلب التحويل لعيادة</label>

            <select name="switch_to_clinic_id" class="form-control select2" >
               <option value="{{$switch_to_clinic->switch_to_clinic_id}}" selected>
                  {{$switch_to_clinic->clinic->name}}
               </option>
            </select>

         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > الزيارة </label>
            <select name="visit_id" class="form-control select2" required>
               <option value="{{$switch_to_clinic->visit_id}}" selected>
                  {{$switch_to_clinic->visit_id}}
               </option>
         </select>
         </div>
      </div>




      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >التاريخ</label>
            <input type="date"  value="{{$switch_to_clinic->date}}" name="req_date" class="form-control" >

         </div>
      </div>
      {{ bs_input("notes"," ملاحظات ",$switch_to_clinic->notes,true) }}

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
   initSelect2($('select[name="clinic_id"]'), "/clinics/select")

</script>
@endsection
