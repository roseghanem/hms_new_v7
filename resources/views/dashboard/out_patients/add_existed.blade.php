@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ route("outpatient.store_exist") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")
    <div class="form-group row mt-2">
        <div class="col-sm-12">
            <label class="col-form-label text-md-left" > المريض</label>

            <select name="patient_id" class="form-control select2" required>
            </select>

        </div>
    </div>

    <div class="form-group row mt-2">
        <div class="col-sm-12">
            <label class="col-form-label text-md-left" >زمرة الدم</label>
            <select name="blood_group_id" class="form-control select2" required>
            </select>

        </div>
    </div>

    {{ bs_save("حفظ") }}

</form>
@endsection

@section('assets')

<script src="{{ url('/select2/select2.full.min.js')}}"></script>
<script src="{{ url('/js/file-input-form-func.js')}}"></script>
<script>
    $('.select2').select2();
    initSelect2($('select[name="blood_group_id"]'), "/blood_groups/select")
    initSelect2($('select[name="patient_id"]'), "/patients/select")
</script>
@endsection
