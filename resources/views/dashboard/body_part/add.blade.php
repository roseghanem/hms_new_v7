@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/body_parts") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
 
     
      
    {{ bs_input("name","اسم العضو",'',true) }}
    {{ bs_save("حفظ") }}
   </div>

</form>
@endsection

 