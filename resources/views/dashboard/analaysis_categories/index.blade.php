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
<a href="{{ url('analaysis_categories/create') }}">
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus "></i> اضافة صنف تحليل مخبري
    </button>
</a>

<div class="container mt-5">
    <h2 class="mb-4"> أصناف التحليل المخبري </h2>

    <table id="yajra-datatable" class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th></th>

                <th>الاسم </th>

                <th></th>


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
            ajax : "{{ route('analysis.category.data') }}",
            method : "GET",
            data:{'search_query':value}
        },
        columns: [
            //edit
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},


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
                $(row).append("<td> " + datum.name + " </td>")


                $(row).append(
                    "<td><div class='btn-group dropright'><button type='button' class='btn btn-secondary bt-s dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Actions </button><div class='dropdown-menu'>"
                    /**Edit**/
                    +
                    "<a style='display:block' class='dropdown-item'href='{{ url('analaysis_categories/edit') }}" + "/" + datum.id +
                    "'> تعديل</a>" +
                    "<a style='display:block' class='dropdown-item'href='{{ url('analaysis_categories/delete') }}" + "/" + datum.id +
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
