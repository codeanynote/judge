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
        <link rel="icon" href="{{Helpers::assets_path('img/favicon.png')}}" type="image/png">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{Helpers::assets_path('css/bootstrap.min.css')}}">
        <!-- Fonts from Font Awsome -->
        <link rel="stylesheet" href="{{Helpers::assets_path('css/font-awesome.min.css')}}">
        <!-- CSS Animate -->
        <link rel="stylesheet" href="{{Helpers::assets_path('css/animate.min.css')}}">
        <!-- Custom styles for this theme -->
        <link rel="stylesheet" href="{{Helpers::assets_path('css/main.css')}}">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="{{Helpers::assets_path('assets/plugins/html5shiv.js')}}"></script>
        <script src="{{Helpers::assets_path('assets/plugins/respond.min.js')}}"></script>
        <![endif]-->
    </head>
    <body class="animated fadeIn">
        <section id="error-container">

            <div class="block-error">

                <header>
                    <h1 class="error">404</h1>
                    <p class="text-center">Page not found</p>
                </header>

                <p class="text-center">Houston, we have a problem. We're having trouble loading the page you are looking for.</p>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-info btn-block btn-3d" href="{{ route('dashboard') }}">Back to Home</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block btn-3d" onclick="history.back();">Previous Page</button>
                    </div>
                </div>
            </div>

        </section>
    <!--Global JS-->
        <script src="{{Helpers::assets_path('js/plugins/jquery.min.js')}}"></script>
        <script src="{{Helpers::assets_path('js/plugins/bootstrap.min.js')}}"></script>
        <script src="{{Helpers::assets_path('js/plugins/jquery.navgoco.min.js')}}"></script>
    </body>
</html>
