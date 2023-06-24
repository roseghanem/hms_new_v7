@extends('dashboard.layouts.index')

@section('content')


    <form action="{{ url('drug_forms/update/'.$drugForm->id) }}" method="post" class="form-horizontal">
        @csrf
        @method('put')

        {{ bs_input("name","الشكل الصيدلاني",$drugForm->name,true) }}
        {{ bs_save("تعديل") }}

    </form>

@endsection

