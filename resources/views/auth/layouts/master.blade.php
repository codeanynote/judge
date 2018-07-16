<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Judge - {{$page_title}}</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Favicon -->
<link rel="shortcut icon" href="{{url('resources/assets/img/favicon.png')}}" type="image/x-icon">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="{{url('resources/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<!-- Fonts from Font Awsome -->
<link rel="stylesheet" href="{{url('resources/assets/css/font-awesome.min.css')}}">
<!-- CSS Animate -->
<link rel="stylesheet" href="{{url('resources/assets/css/animate.css')}}">
<!-- Custom styles for this theme -->
<link rel="stylesheet" href="{{url('resources/assets/css/main.css')}}">

<link rel="stylesheet" href="{{url('resources/assets/css/style.css')}}">
<!-- Fonts -->
<!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>-->
<!-- Feature detection -->
<script src="{{url('resources/assets/js/modernizr-2.6.2.min.js')}}"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="{{url('resources/assets/js/html5shiv.js')}}"></script>
<script src="{{url('resources/assets/js/respond.min.js')}}"></script>
<![endif]-->
</head>

<body class="animated fadeIn overflow-x-hidden">
    <section id="login-container">
        <div class="row">
            <div class="col-md-3 login-register-header">
                <center>
                    <h3>Judge Management System</h3>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" id="login-wrapper">
                <div class="panel panel-primary animated flipInY">
                    <div class="panel-heading">
                        <h3 class="panel-title">     
                            {{$page_title}}
                        </h3>      
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 login-register-footer">
                <center>
                    <div class="login-footer-logo"></div>
                    <span style="font-size:11px;">Created by 2017 – judges2017@gmail.com</span>
                </center>
            </div>
        </div>

    </section>
    <!--Global JS-->
    <script src="{{url('resources/assets/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{url('resources/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('resources/assets/plugins/waypoints/waypoints.min.js')}}"></script>
    <script src="{{url('resources/assets/js/application.js')}}"></script>
</body>

</html>