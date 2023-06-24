@extends('dashboard.layouts.index')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">الحجوزات المتاحة</h2>
        <table id="yajra-datatable" class="table table-bordered yajra-datatable">
            <thead>
            <tr>
                <th>التاريخ</th>
                <th>الوقت</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            @for($i=0;$i< 5-$all_today_appointments;$i++)
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::today()->format('d/m/Y') }}</td>
                    <td>{{ $i }}</td>
                    <td><a class="btn btn-primary" href="{{route('set_appointment',[$patient->id,$i])}}">حجز</a></td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
