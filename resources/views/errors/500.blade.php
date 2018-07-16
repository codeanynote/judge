<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SpaceLab</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Favicon -->
        <link rel="icon" href="{{Helpers::admin_view('assets/img/favicon.png')}}" type="image/png">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{Helpers::admin_view('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <!-- Fonts from Font Awsome -->
        <link rel="stylesheet" href="{{Helpers::admin_view('assets/css/font-awesome.min.css')}}">
        <!-- CSS Animate -->
        <link rel="stylesheet" href="{{Helpers::admin_view('assets/css/animate.css')}}">
        <!-- Custom styles for this theme -->
        <link rel="stylesheet" href="{{Helpers::admin_view('assets/css/main.css')}}">
        <!-- Feature detection -->
        <script src="{{Helpers::admin_view('assets/plugins/modernizr-2.6.2.min.js')}}"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="{{Helpers::admin_view('assets/plugins/html5shiv.js')}}"></script>
        <script src="{{Helpers::admin_view('assets/plugins/respond.min.js')}}"></script>
        <![endif]-->
    </head>
    <body class="animated fadeIn">
        <section id="error-container">

            <div class="block-error">

                <header>
                    <h1 class="error">500</h1>
                    <p class="text-center">Something went wrong.</p>
                </header>

                <p class="text-center">Sorry, we have a problem. Please try again later.</p>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info btn-block btn-3d" href="#" onclick="history.back();">Back</a>
                    </div>
                </div>
            </div>

        </section>
    <!--Global JS-->
        <script src="{{Helpers::admin_view('assets/plugins/jquery-1.10.2.min.js')}}"></script>
        <script src="{{Helpers::admin_view('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{Helpers::admin_view('assets/plugins/navgoco/jquery.navgoco.min.js')}}"></script>
        <script src="{{Helpers::admin_view('assets/plugins/waypoints/waypoints.min.js')}}"></script>
        <script src="{{Helpers::admin_view('assets/js/application.js')}}"></script>
    </body>
</html>
