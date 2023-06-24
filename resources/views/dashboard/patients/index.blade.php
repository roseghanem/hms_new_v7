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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ url('css/bootstrap-theme.min.css') }}" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
@endsection
@section('content')


<div class="container mt-5">
    <h2 class="mb-4">المرضى</h2>

    <table id="yajra-datatable" class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>رقم المريض</th>
                <th>اسم المريض</th>
                <th>اسم الاب</th>
                <th>الكنية </th>
                <th>اسم الام</th>
                <th>الجنس</th>
                <th>رقم المستشفى</th>
                <th>الرقم الوطني</th>
                <th>identity_number</th>

            </tr>
        </thead>
        <tbody>
        @foreach($patients as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->first_name }}</td>
                <td>{{ $row->father_name }}</td>
                <td>{{ $row->last_name }}</td>
                <td>{{ $row->mother_name }}</td>
                <td>{{ $row->gender }}</td>
                <td>{{ $row->hospital_number }}</td>
                <td>{{ $row->national_number }}</td>
                <td>{{ $row->identity_number }}</td>
            </tr>
        @endforeach
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

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script type="text/javascript">

    $('#createNewProduct').click(function () {



        $('#ajaxModel').modal('show');

    });


    function reload(value=null)
    {
        $('#yajra-datatable').DataTable({


        processing: true,
        serverSide: true,
        //edit
        ajax:
        {
            url : "{{ route('get_patients.data') }}" ,
            method : "GET",
            data:{'search_query':value}
        },
        columns: [
            //edit
            {data: 'id', name: 'id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'father_name', name: 'father_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'mother_name', name: 'mother_name'},
            {data: 'gender', name: 'gender'},
            {data: 'hospital_number', name: 'hospital_number'},
            {data: 'national_number', name: 'national_number'},
            {data: 'identity_number', name: 'identity_number'},

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
                $(row).append("<td> " + datum.first_name + " </td>")
                $(row).append("<td> " + datum.father_name + " </td>")
                /* append name columns */
                $(row).append("<td> " + datum.last_name + " </td>")
                $(row).append("<td> " + datum.mother_name + " </td>")
                /* append name columns */
                $(row).append("<td> " + datum.gender + " </td>")
                $(row).append("<td> " + datum.hospital_number + " </td>")
                /* append name columns */
                $(row).append("<td> " + datum.national_number + " </td>")
                $(row).append("<td> " + datum.identity_number + " </td>")
                // $(row).append("<td> " + datum.blood_name + " </td>")

                $(row).append(
                    "<td>"
                    /**Edit**/
                    +
                    "<a style='display:inline-block' class='btn btn-info ' href='{{ url('patients/get_appointments') }}" + "/" + datum.id +
                    "'> حجز موعد </a>" +
                     "</td>")
            }

        }
    });
}


    // $('input[name="search_query"]').keyup(function(evt) {
    //     //console.log("dfdf");
    //     let value = $('input[name="search_query"]').val();
    //     reload(value);
    // });

    $('#yajra-datatable_filter input').keyup(function(evt) {
       // console.log("dfdf");
        console.log("dfdf");
        let value = $('#yajra-datatable_filter input').val();
        reload(value);
    });
    reload();

    // $('input[name="search_query"]').keyup(function(evt) {
    //     let value = $('input[name="search_query"]').val();
    //     reload(value);
    // });
    // reload();


  $.fn.dataTableExt.errMode = 'ignore';

</script>
@endsection
