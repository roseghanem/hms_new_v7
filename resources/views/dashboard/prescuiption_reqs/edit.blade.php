@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/prescuiption_reqs/update/'.$prescuiption_req->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
    <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" >الزيارة </label>
           <select name="visit_id" class="form-control select2" >
            <option value="{{$prescuiption_req->visit_id}}" selected>
             {{$prescuiption_req->visit_id}}
              </option>
         </select>

        </div>
     </div>

   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >الشكل الصيدلاني </label>
         <select name="drug_form_id" class="form-control select2" >
            <option value="{{$prescuiption_req->drug_form_id}}" selected>
               {{$prescuiption_req->drugForm->name}}
           </option>
        </select>
      </div>
   </div>

   {{ bs_input("scientific_name","اسم الدواء",$prescuiption_req->scientific_name,true) }}
   {{ bs_input("gag","العيار ",$prescuiption_req->gag,true) }}
  {{ bs_input("gag_unit","  الواحدة",$prescuiption_req->gag_unit,true) }}
  {{ bs_input("quantity","الكمية ",$prescuiption_req->quantity,true) }}
  {{ bs_input("quantity_unit","واحدة الكمية ",$prescuiption_req->quantity_unit,true) }}
  {{ bs_input("Treatment_Peroid","فترة العلاج ",$prescuiption_req->Treatment_Peroid,true) }}
  {{ bs_input("method_of_use"," طريقة الاعطاء ",$prescuiption_req->method_of_use,true) }}

   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >التاريخ</label>
         <input type="date" value="{{$prescuiption_req->req_date}}" name="req_date" class="form-control">
      </div>
   </div>

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
   initSelect2($('select[name="drug_from_id"]'), "/drug_forms/select")
  </script>
@endsection
