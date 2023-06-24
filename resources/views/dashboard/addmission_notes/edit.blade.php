@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/addmission_notes/update/'.$addmissionNote->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > مذكرة القبول</label>


         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > الزيارة </label>
            <select name="visit_id" class="form-control select2" required>
               <option value="{{$addmissionNote->visit_id}}" selected>
                  {{$addmissionNote->visit_id}}
               </option>
         </select>
         </div>
      </div>
      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" > الشعبة</label>
            <select name="division_id" class="form-control select2" required>
               <option value="{{$addmissionNote->division_id}}" selected>
                  {{$addmissionNote->division->id}}
                  {{$addmissionNote->division->name}}

               </option>
            </select>
         </div>
      </div>

      <div class="form-group row mt-2">
         <div class="col-sm-12">
            <label class="col-form-label text-md-left" >التاريخ</label>
            <input type="date"  value="{{$addmissionNote->date}}" name="date" class="form-control" required>

         </div>
      </div>
      {{ bs_input("notes","ملاحظات",$addmissionNote->notes,true) }}
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
   initSelect2($('select[name="division_id"]'), "/divisions/select")

</script>
@endsection
