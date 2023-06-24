@extends('dashboard.layouts.index')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">الحجوزات المؤقتة</h2>
        <table id="yajra-datatable" class="table table-bordered yajra-datatable">
            <thead>
            <tr>
                <th>المريض</th>
                <th>التاريخ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($temporary_appointments as $temporary_appointment)
                <tr>
                    <td>{{ $temporary_appointment->patient->first_name }} {{ $temporary_appointment->patient->last_name }}</td>
                    <td>{{ $temporary_appointment->appointment_time }}</td>

                    <td><a class="btn btn-primary" href="{{route('paid',$temporary_appointment->id)}}">دفع</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
