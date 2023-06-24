<body class="rtl">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container" style="background-color: #113a3dba;">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button" style="background-color: yellow">
                    <span class="clip-list-2"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/dashboard') }}" style="color: white;">
              مستشفى الأسد الجامعي
                </a>
            </div>
            <div class="navbar-tools">
                <ul class="nav navbar-right" style="background-color:white;">

                    <li class="dropdown current-user">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true"
                            href="#">

                            <span class="username"></span>
                            <i class="clip-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="pages_user_profile.html">
                                    <i class="clip-user-2"></i>
                                    &nbsp;My Profile
                                </a>
                            </li>


                            <li class="divider"></li>

                            <li>
                                <a href="{{ url('dashboard/logout') }}">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="navbar-content">
            <div class="main-navigation navbar-collapse collapse">
                <div class="navigation-toggler">
                    <i class="clip-chevron-left"></i>
                    <i class="clip-chevron-right"></i>
                </div>
                <ul class="main-navigation-menu" style="background-color:#dbf2f7;">
                    <li class="">
                        <a href="{{ route('get_patients') }}"><i class="clip-list"></i>
                            <span class="title">حجز المواعيد </span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('get_temporary_appointments') }}"><i class="clip-list"></i>
                            <span class="title"> وصل الدفع </span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('today_appointments') }}"><i class="clip-list"></i>
                            <span class="title"> مواعيد اليوم </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/') }}"><i class="clip-list"></i>
                            <span class="title">  اضافة موعد </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/blood_groups') }}"><i class="clip-list"></i>
                            <span class="title">زمر الدم </span>
                        </a>
                    </li>


                    <li class="">
                        <a href="{{ url('/out_patients') }}"><i class="clip-list"></i>
                            <span class="title">المريض الخارجي </span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ url('/visits') }}"><i class="clip-list"></i>
                            <span class="title">الزيارة </span>
                        </a>
                    </li>
                                       <li class="">
                        <a href="{{ url('/scan_units') }}"><i class="clip-list"></i>
                            <span class="title">وحدات الأشعة </span>
                        </a>
                    </li>


                    <li class="">
                        <a href="{{ url('/analaysis_categories') }}"><i class="clip-list"></i>
                            <span class="title">أصناف التحليل المخبري </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/analaysis_reqs') }}"><i class="clip-list"></i>
                            <span class="title">طلب تحليل مخبري    </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/body_parts') }}"><i class="clip-list"></i>
                            <span class="title">العضو المراد تصويره </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/scan_requests') }}"><i class="clip-list"></i>
                            <span class="title">طلب الاشعة </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/switch_to_clinics') }}"><i class="clip-list"></i>
                            <span class="title">طلب التحويل لعيادة </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/drug_forms') }}"><i class="clip-list"></i>
                            <span class="title">الشكل الصيدلاني </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/prescuiption_reqs') }}"><i class="clip-list"></i>
                            <span class="title">الوصفة الطبية   </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/addmission_notes') }}"><i class="clip-list"></i>
                            <span class="title">مذكرة قبول</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ url('/') }}"><i class="clip-list"></i>
                            <span class="title"> طلب تشريح مرضي</span>
                        </a>
                    </li>


                 <!--   <li class="">
                        <a href="#"><i class="clip-book"></i>
                            <span class="title"> {{ __("dashboard.competitionsDeb") }} </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ url('dashboard/qustions') }}">
                                    <i class="fa fa-plus "></i> {{__("dashboard.qustions")}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/competitions') }}">
                                    <i class="fa fa-plus "></i>
                                    {{__("dashboard.competitions")}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/evaluations') }}">
                                    <i class="fa fa-plus "></i>
                                    {{__("dashboard.evaluations")}}
                                </a>
                            </li>
                        </ul>
                    </li> -->

                </ul>
                </li>






                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">


            <div class="row">
                <div class="col-sm-12">

                    <ol class="breadcrumb">
                        <li class="search-box">
                            <form class="sidebar-search" method="get" action="{{ url()->current() }}">
                                <div class="form-group">
                                    <input type="text" placeholder="{{ __('بحث') }}" name="search">
                                    <button class="submit">
                                        <i class="clip-search-3"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ol>
                    <div class="page-header">
   <!--  <li>
                       <a href="#">

                      <img src="C:\Users\IT\Desktop\sarab\assad-backend\assad-backend\resources\views\dashboard\images\clinic.png" style="width:100px;height:30px;" />
                        </a>
                       </li> -->
                        <h1>نظام العيادات الطبية</h1>

                    </div>
                </div>
            </div>
            @if (session("success"))
            {{ alert_box("success",session("success")) }}
            @endif

            @if (session("error"))
            {{ alert_box("danger",session("error")) }}
            @endif


            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
