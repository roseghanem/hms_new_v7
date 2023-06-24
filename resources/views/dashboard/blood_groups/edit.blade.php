@extends('dashboard.layouts.index')

@section('content')
 

    <form action="{{ url('blood_groups/update/'.$bloodGroup->id) }}" method="post" class="form-horizontal">
        @csrf
        @method('put')
    
        {{ bs_input("name","اسم الزمرة",$bloodGroup->name,true) }}
        {{ bs_save("تعديل") }}

        
    
     
    
    </form>



    

 
 
@endsection

