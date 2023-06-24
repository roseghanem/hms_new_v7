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
<a href="{{ url('prescuiption_reqs/create') }}">
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus "></i> اضافة وصفة جديدة
    </button>
</a>

<div class="container mt-5">
    <h2 class="mb-4"> طلب وصفة طبية</h2>

    <table id="yajra-datatable" class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th> رقم متسلسسل</th>
                <th> أسم الدواء</th>
                <th> العيار</th>
                <th>واحدة العيار </th>
                <th> الكمية</th>
                <th>واحدة الكمية</th>
                <th> الشكل الصيدلاني</th>
                <th>فترة العلاج </th>
                <th> طريقة الاعطاء</th>
                <th> رقم الزيارة</th>
                <th>التاريخ</th>
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
            url : "{{ route('pre_req.data') }}" ,
            method : "GET",
            data:{'search_query':value}
        },
        columns: [
            //edit
            {data: 'id', name: 'id'},
            {data: 'scientific_name', name: 'scientific_name'},
            {data: 'gag', name: 'gag'},
            {data: 'gag_unit', name: 'gag_unit'},
            {data: 'quantity', name: 'quantity'},
            {data: 'quantity_unit', name: 'quantity_unit'},
            {data: 'drug_form_id', name: 'drug_form_id'},
            {data: 'Treatment_Peroid', name: 'Treatment_Peroid'},
            {data: 'method_of_use', name: 'method_of_use'},
            {data: 'visit_id', name: 'visit_id'},
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
                $(row).append("<td> " + datum.scientific_name + " </td>")
                $(row).append("<td> " + datum.gag + " </td>")
                $(row).append("<td> " + datum.gag_unit + " </td>")
                $(row).append("<td> " + datum.quantity + " </td>")
                $(row).append("<td> " + datum.quantity_unit + " </td>")
                $(row).append("<td> " + datum.drug_form_name + " </td>")
                $(row).append("<td> " + datum.Treatment_Peroid + " </td>")
                $(row).append("<td> " + datum.method_of_use + " </td>")
                $(row).append("<td> " + datum.visit_id + " </td>")
                $(row).append("<td> " + datum.date + " </td>")
                $(row).append(
                    "<td><div class='btn-group dropright'><button type='button' class='btn btn-secondary bt-s dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Actions </button><div class='dropdown-menu'>"
                    /**Edit**/
                    +
                    "<a style='display:block' class='dropdown-item'href='{{ url('prescuiption_reqs/edit') }}" + "/" + datum.id +
                    "'> تعديل</a>" +
                    "<a style='display:block' class='dropdown-item'href='{{ url('prescuiption_reqs/delete') }}" + "/" + datum.id +
                    "'>  حذف</a>" + "</div></div> </td>")
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
