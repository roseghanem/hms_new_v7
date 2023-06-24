@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/scan_units") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
 
     
      
    {{ bs_input("name","اسم وحدة الاشعة",'',true) }}
    {{ bs_input("phone","رقم الهاتف",'',true) }}
    {{ bs_save("حفظ") }}
   </div>

</form>
@endsection

 