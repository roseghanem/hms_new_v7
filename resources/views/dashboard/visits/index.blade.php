@extends('dashboard.layouts.index')
@section('style')
    .card-btn{
    border-radius : 0px;
    }
    .fa-eye, .fa-edit, .fa-trash
    {
    color:#1c2d41;
    }
    .dataTables_wrapper:after {
    visibility: hidden;
    display: block;
    content: "";
    clear: both;
    height: 0;
    background-color: red!important;
    color: #01caf1;
    }
    .paginate_button:hover
    {
    border:2px solid #1c2d41!important;
    color:#1c2d41!important;
    }
    <link rel="stylesheet" href="{{ url('css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/card-form-style.css') }}">
    <link rel="stylesheet" href="{{ url('/css/custom-dataTable-style.css') }}">
@endsection
@section('content')
<a href="{{ url('visits/create') }}">
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus "></i> اضافة زيارة جديدة
    </button>
</a>

<div class="container mt-5">
    <h2 class="mb-4"> زيارات المرضى </h2>

    <table id="yajra-datatable" class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th> رقم مسلسسل</th>
                <th> الدكتور</th>
                <th> المريض</th>
                <th> العيادة</th>
                <th>القصة المرضية</th>
                <th>السوابق المرضية</th>
                <th>  السوابق العائلية</th>
                <th>السوابق التحسيسة</th>
                <th>السوابق الجراحية</th>
                <th>العادات</th>
                <th> التشخيص</th>
                <th>التاريخ</th>
                <!--<th>رقم طلب التصوير الشعاعي</th>-->
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


@endsection

@section('assets')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{ url('js/dataTables.min.js') }}"></script>



<script type="text/javascript">




    function reload(value=null)
    {
        $('#yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        //edit
        ajax:
        {
            url : "{{ route('visit.data') }}" ,
            method : "GET",
            data:{'search_query':value}
        },
        columns: [
            //edit
            {data: 'id', name: 'id'},
            {data: 'doctor_name', name: 'doctor_name'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'clinic_name', name: 'clinic_name'},
            {data: 'patient_history', name: 'patient_history'},
            {data: ' medical_history', name: ' medical_history'},
            {data: 'family_history', name: 'family_history'},
            {data: 'allergic_history', name: 'allergic_history'},
            {data: 'surgical_history', name: 'surgical_history'},
            {data: 'habits', name: 'habits'},
            {data: 'diseas_name', name: 'diseas_name'},
            {data: 'date', name: 'date'},
           ],

        "initComplete": function(settings, json) {
        } ,
        "createdRow": function (row, data, index) {
        },
        "order":  []  ,
        "columnDefs": [ { "orderable": false, "targets":[ 0 ]  } ],

        "drawCallback":
        function(event) {


            console.log("drawCallback PARAMS : ", event)
            console.log("drawCallback DATA : ", event.json.data)

            let data = event.json.data;
            if (data.length == 0) {
                return;
            }

            let TRs = $('#yajra-datatable')[0].rows;

            for (let i = 1; i < TRs.length; i++)
            {
                let row = TRs[i];
                let datum = data[i - 1];

                $(row).children('td').remove()
                /* append number of rows */


                //edit
                $(row).append("<td> " + datum.id + " </td>")
                /* append name columns */
                $(row).append("<td> " + datum.doctor_name + " </td>")
                $(row).append("<td> " + datum.patient_name + " </td>")
                $(row).append("<td> " + datum.clinic_name + " </td>")
                $(row).append("<td> " + datum.patient_history + " </td>")
                $(row).append("<td> " + datum.medical_history + " </td>")
                $(row).append("<td> " + datum.family_history + " </td>")
                $(row).append("<td> " + datum.allergic_history + " </td>")
                $(row).append("<td> " + datum.surgical_history + " </td>")
                $(row).append("<td> " + datum.habits + " </td>")
                $(row).append("<td> " + datum.diseas_name + " </td>")
                //$(row).append("<td> " + datum.scan_req_id + " </td>")
                $(row).append("<td> " + datum.date + " </td>")
                $(row).append(
                    "<td><div class='btn-group dropright'><button type='button' class='btn btn-secondary bt-s dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Actions </button><div class='dropdown-menu'>"
                    /**Edit**/
                    +
                    "<a style='display:block' class='dropdown-item'href='{{ url('visits/edit') }}" + "/" + datum.id +
                    "'> تعديل</a>" +

                    "<a style='display:block' class='dropdown-item'href='{{ url('scan_requests/create') }}" +
                    "'>  اضافة طلب اشعة'</a>" +

                     "<a style='display:block' class='dropdown-item'href='{{ url('prescuiption_reqs/create') }}" +
                    "'>  اضافة وصفة طبية </a>" +

                    "<a style='display:block' class='dropdown-item'href='{{ url('addmission_notes/create') }}" +
                    "'>  اضافة مذكرة قبول </a>" +


                    "<a style='display:block' class='dropdown-item'href='{{ url('switch_to_clinics/create') }}" +
                    "'>  اضافة طلب تحويل </a>" +
                    "<a style='display:block' class='dropdown-item'href='{{ url('visits/delete') }}" + "/" +datum.id +
                    "'>حذف</a>" +

                    "</div></div> </td>")

            }



        }
    });
}


    $('input[name="search_query"]').keyup(function(evt) {
        let value = $('input[name="search_query"]').val();
        reload(value);
    });
    reload();





  $.fn.dataTableExt.errMode = 'ignore';

</script>
@endsection
