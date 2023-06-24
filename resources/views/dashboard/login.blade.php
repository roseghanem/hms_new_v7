<!DOCTYPE html>

<html lang="ar" class="no-js">

<head>
    <title>{{ __("dashboard.brand") }} - {{ __("dashboard.logIn") }}</title>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/fonts/style.css">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/css/main.css">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/css/main-responsive.css">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/plugins/iCheck/skins/all.css">
    <link rel="stylesheet"
        href="{{ url('/assets/dashboard') }}/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
    <link rel="stylesheet"
        href="{{ url('/assets/dashboard') }}/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/css/theme_light.css" type="text/css"
        id="skin_color">
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/css/print.css" type="text/css" media="print" />
    <link rel="stylesheet" href="{{ url('/assets/dashboard') }}/assets/css/login.css" type="text/css" />
</head>

<body class="login example2">
    <div class="main-login col-sm-4 col-sm-offset-4">
        <div class="logo">
        </div>
        <div class="box-login">
            <h3>{{ __("dashboard.logIn") }}</h3>
            <h6>{{ __("dashboard.enterLoginInformation") }}</h6>


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


            <form class="form-login" action="{{ url('/dashboard/login') }}" method="POST">
                @csrf
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email"
                                placeholder="{{ __('dashboard.email') }}">
                            <i class="fa fa-user"></i> </span>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="password" class="form-control" name="password"
                                placeholder="{{ __('dashboard.password') }}">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <div class="form-actions">

                        <button type="submit" class="btn btn-bricky pull-right">
                            {{ __("dashboard.logIn") }} <i class="fa fa-arrow-circle-left"></i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="copyright">
            {{ date("Y") }} &copy; Medical .
        </div>
    </div>

</body>

</html>
