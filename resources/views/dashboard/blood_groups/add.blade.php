@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/blood_groups") }}' class="form-horizontal" method="post">
    
    @csrf
    @method("POST")

    {{ bs_input("name","اسم الزمرة",'',true) }}
    {{ bs_save("حفظ") }}

</form>
@endsection
