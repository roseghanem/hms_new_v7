@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/analaysis_reqs/update/'.  $analaysisReq->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >  طلب تحليل</label>


         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > الزيارة </label>
            <select name="visit_id" class="form-control select2" required>
               <option value="{{$analaysisnReq->visit_id}}" selected>
                  {{$analaysisnReq->visit_id}}
               </option>
         </select>
         </div>
      </div>
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > أسم التحليل</label>
            <select name="analaysis_category_id" class="form-control select2" required>
               <option value="{{$analaysisReq->analaysis_category_id}}" selected>
                {{$analaysisnReq->analaysis_category->id}}
                {{$analaysisnReq->analaysis_category->name}}

               </option>
            </select>
         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >التاريخ</label>
            <input type="date"  value="{{$analaysisReq->date}}" name="date" class="form-control" >

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
   initSelect2($('select[name="analaysis_category_id"]'), "/analaysis_categories/select")
</script>
@endsection
