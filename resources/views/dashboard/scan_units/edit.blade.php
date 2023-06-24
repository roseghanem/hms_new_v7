@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/scan_units/update/'.$scan_unit->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
    {{ bs_input("name","اسم وحدة الاشعة",$scan_unit->name,true) }}
    {{ bs_input("phone","رقم الهاتف",$scan_unit->phone,true) }}
    {{ bs_save("تعديل") }}

   

</form>
@endsection

 
 