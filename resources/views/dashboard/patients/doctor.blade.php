
@extends('dashboard.layouts.index')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">الحجوزات المثبتة لليوم</h2>
        <br>
        <table id="yajra-datatable" class="table table-bordered yajra-datatable">
            <thead>
            <tr>
                <th>المريض</th>
                <th>التاريخ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients_appointments as $patient_appointment)
                <tr>
                    <td>{{ $patient_appointment->patient->first_name }} {{ $patient_appointment->patient->last_name }}</td>
                    <td>{{ $patient_appointment->appointment_time }}</td>

                    <td><a class="btn btn-primary" href="">فتح زيارة</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
