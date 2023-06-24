@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('/analaysis_categories/update/'.$analaysis_category->id)}}" class="form-horizontal" method="post">
    @csrf
    @method("PUT")
    {{ bs_input("name","صنف التحليل المخبري",$analaysis_category->name,true) }}
    {{ bs_save("تعديل") }}



</form>
@endsection


