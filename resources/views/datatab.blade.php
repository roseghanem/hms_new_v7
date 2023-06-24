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
    <a href="{{ url('out_patients/create') }}">
        <button class="btn btn-success" style="margin-bottom: 25px;">
            <i class="fa fa-plus "></i>اضافة مريض خارجي جديد
        </button>
    </a>

    <div class="container mt-5">
        <h2 class="mb-4"> مريض الخارجي</h2>

        <table id="files_list" class="table table-striped dt-responsive  " style="width:100%">
            <thead>
            <tr>
                <th>الرقم المتسلسل</th>
                <th>اسم المريض</th>
                <th>نسبة المريض</th>
                <th> زمرة الدم</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> 1</td>
                <td>e</td>
                <td>ahmad</td>
                <td>A-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>
            <tr>
                <td> 2</td>
                <td>ali</td>
                <td>ahmad</td>
                <td>A-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>
            <tr>
                <td> 3</td>
                <td>yousef</td>
                <td>ali</td>
                <td>B-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>
            <tr>
                <td> 3</td>
                <td>mhmmad</td>
                <td>ahmad</td>
                <td>A-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>
            <tr>
                <td> 4</td>
                <td>belal</td>
                <td>ahmad</td>
                <td>A-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>
            <tr>
                <td> 5</td>
                <td>rami</td>
                <td>ahmad</td>
                <td>A-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>
            <tr>
                <td>6</td>
                <td>adnan</td>
                <td>ahmad</td>
                <td>A-</td>
                <td><button class="btn btn-seconadry">Actions</button> </td>
            </tr>

            </tbody>
        </table>
    </div>


@endsection
@section('assets')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#files_list').DataTable({
                "aLengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                "iDisplayLength": 10,

                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                }
            });
        });

    </script>
@endsection
