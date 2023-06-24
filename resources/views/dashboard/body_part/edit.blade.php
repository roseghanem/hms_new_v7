@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/body_parts/update/'.$body_part->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
    {{ bs_input("name","اسم العضو",$body_part->name,true) }}
    {{ bs_save("تعديل") }}



</form>
@endsection


