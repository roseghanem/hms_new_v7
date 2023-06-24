@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/analaysis_reqs") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")




    <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" >اسم التحليل</label>
           <select name="analaysis_category_id" class="form-control select2" required>
           </select>

        </div>
     </div>

     <div class="form-group row mt-2">
        <div class="col-sm-12">
           <label class="col-form-label text-md-left" > رقم الزيارة</label>
           <select name="visit_id" class="form-control select2" required>
          </select>
        </div>
     </div>



   <div class="form-group row mt-2">
      <div class="col-sm-12">
         <label class="col-form-label text-md-left" >التاريخ</label>
         <input type="date" name="date" class="form-control" required>

      </div>
   </div>

   {{ bs_input("notes","ملاحظات",'',true) }}


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
   initSelect2($('select[name="analaysis_category_id"]'), "/analaysis_categories/select")


</script>
@endsection
