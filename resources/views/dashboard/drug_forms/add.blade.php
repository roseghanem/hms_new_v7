@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("/drug_forms") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
    {{ bs_input("name","الشكل الصيدلاني",'',true) }}
    {{ bs_save("حفظ") }}

</form>
@endsection
