@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/analaysis_categories") }}' class="form-horizontal" method="post">
    @csrf

    @method("POST")



    {{ bs_input("name","صنف التحليل المخبري",'',true) }}
    {{ bs_save("حفظ") }}
   </div>

</form>
@endsection

