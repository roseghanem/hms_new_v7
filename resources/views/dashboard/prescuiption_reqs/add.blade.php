@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("prescuiption_reqs") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
   <!-- <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" >اسم الدواء </label>

           <select name="scientific_name_id" class="form-control select2" required>
           </select>

        </div>
     </div> -->



    {{ bs_input("scientific_name","اسم الدواء",'',true) }}
    {{ bs_input("gag","العيار ",'',true) }}
    {{ bs_input("gag_unit","  الواحدة",'',true) }}
    {{ bs_input("quantity","الكمية ",'',true) }}
    {{ bs_input("quantity_unit","واحدة الكمية ",'',true) }}
    {{ bs_input("Treatment_Peroid","فترة العلاج ",'',true) }}
    {{ bs_input("method_of_use"," طريقة الاعطاء ",'',true) }}


   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >الزيارة</label>
         <select name="visit_id" class="form-control select2" required>
        </select>
      </div>
   </div>

   <div class="form-group row mt-2">
    <div class="col-sm-12">
       <label class="col-form-label text-md-left" >الشكل الصيدلاني</label>
       <select name="drug_form_id" class="form-control select2" required>
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
   initSelect2($('select[name="drug_form_id"]'), "/drug_forms/select")

  </script>
@endsection
