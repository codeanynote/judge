<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Judge - {{$page_title}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{url('resources/assets/img/favicon.png')}}" type="image/x-icon">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{url('resources/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Icons -->
        <link rel="stylesheet" href="{{url('resources/assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{url('resources/assets/css/simple-line-icons.css')}}">
        <!-- CSS Animate -->
        <link rel="stylesheet" href="{{url('resources/assets/css/animate.css')}}">
        <!-- Switchery -->
        <link rel="stylesheet" href="{{url('resources/assets/plugins/switchery/switchery.min.css')}}">
        <!-- Custom styles for this theme -->
        <link rel="stylesheet" href="{{url('resources/assets/css/main.css')}}">
        <!-- Vector Map  -->
        <link rel="stylesheet" href="{{url('resources/assets/plugins/jvectormap/css/jquery-jvectormap-1.2.2.css')}}">
        <!-- ToDos  -->
        <link rel="stylesheet" href="{{url('resources/assets/plugins/todo/css/todos.css')}}">
        <!-- Morris  -->
        <link rel="stylesheet" href="{{url('resources/assets/plugins/morris/css/morris.css')}}">  

        <link rel="stylesheet" href="{{url('resources/assets/plugins/icheck/css/_all.css')}}">

        <link rel="stylesheet" href="{{url('resources/assets/plugins/datepicker/datepicker.min.css')}}">
        <link rel="stylesheet" href="{{url('resources/assets/css/jquery.auto-complete.css')}}"> 

        <link rel="stylesheet" href="{{url('resources/assets/css/style.css')}}">

        <!-- Fonts -->
        <!--        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>-->
        <!-- Feature detection -->
        <script src="{{url('resources/assets/js/modernizr-2.6.2.min.js')}}"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="{{url('resources/assets/js/html5shiv.js')}}"></script>
        <script src="{{url('resources/assets/js/respond.min.js')}}"></script>
        <![endif]-->
        @yield('style')
    </head>

    <body class="off-canvas">
        <div id="container">
            <header id="header">
                <!--logo start-->
                <div class="brand">
                    <a href="{{route('dashboard')}}" class="logo"><span>Badminton</span> Judge</a>
                </div>
                <!--logo end-->
                <div class="toggle-navigation toggle-left">
                    <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Toggle Navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                @include('header')
            </header>
            <!--sidebar left start-->
            <nav class="sidebar sidebar-left">
                @include('mainmenu')
            </nav>
            <!--sidebar left end-->
            <!--main content start-->
            <section class="main-content-wrapper">
                <section id="main-content">
                    @yield('content')
                </section>
            </section>
        </div>
        <!--main content end-->
        <!--sidebar right start-->
        <div class="sidebarRight">
            <div id="rightside-navigation">
                <div id="right-panel-tabs" role="tabpanel">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a data-target="#chat" data-toggle="tab" role="tab" data-toggle="tab" title="Chat"><i class="icon-users fa-lg"></i></a>
                        </li>
                        <li><a data-target="#settings" role="tab" data-toggle="tab" title="Settings"><i class="icon-settings fa-lg"></i></a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="settings">
                            <ul class="setting-list">
                                <li>
                                    <h3 class="sidebar-title">Account Settings</h3>
                                </li>
                                <li>
                                    <h5>Share your status</h5>
                                    <input type="checkbox" class="js-switch" checked />
                                </li>
                                <li>
                                    Vivamus sagittis lacus vel augue laoreet rutrums.
                                </li>
                                <li>
                                    <h5>Notifications</h5>
                                    <input type="checkbox" class="js-switch" />
                                </li>
                                <li>
                                    Vivamus sagittis lacus vel augue laoreet rutrums.
                                </li>
                                <li>
                                    <h5>Vacation responder</h5>
                                    <input type="checkbox" class="js-switch" checked />
                                </li>
                                <li>
                                    Vivamus sagittis lacus vel augue laoreet rutrums.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--sidebar right end-->
        <!--Global JS-->
        <script src="{{url('resources/assets/js/jquery-1.10.2.min.js')}}"></script>
        <script src="{{url('resources/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{url('resources/assets/plugins/navgoco/jquery.navgoco.min.js')}}"></script>
        <script src="{{url('resources/assets/plugins/waypoints/waypoints.min.js')}}"></script>
        <script src="{{url('resources/assets/plugins/switchery/switchery.min.js')}}"></script>
        <script src="{{url('resources/assets/js/application.js')}}"></script>
        <!--Page Level JS-->
        <script src="{{url('resources/assets/plugins/countTo/jquery.countTo.js')}}"></script>
        <script src="{{url('resources/assets/plugins/weather/js/skycons.js')}}"></script>

        <!-- Vector Map  -->
        <script src="{{url('resources/assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{url('resources/assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- ToDo List  -->
        <script src="{{url('resources/assets/plugins/todo/js/todos.js')}}"></script>
        <!--Load these page level functions-->
        <script src="{{url('resources/assets/plugins/icheck/js/icheck.min.js')}}"></script>
        <script src="{{url('resources/assets/js/printObject.js')}}"></script>
        <script src="{{url('resources/assets/js/jquery.autocomplete.js')}}"></script>
        <script src="{{url('resources/assets/plugins/datepicker/datepicker.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script>
$(document).ready(function () {
    $('input.icheck').iCheck({
        checkboxClass: 'icheckbox_flat-grey',
        radioClass: 'iradio_flat-grey'
    });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoHide: true
    });
});
        </script>
        @yield('script')
    </body>

</html>
