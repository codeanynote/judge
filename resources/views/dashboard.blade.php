<!--
    User Dashboard View Content
-->
@extends('master')
@section('style')
@stop
@section('content')
    <!--tiles start-->
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="dashboard-tile detail tile-red">
                <div class="content">
                    <p>Total</p>
                    <h1 class="text-left timer" data-from="0" data-to="{{$event_count}}" data-speed="2500"> </h1>
                    <p>of Events</p>
                </div>
                <div class="icon"><i class="fa fa fa-line-chart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="dashboard-tile detail tile-turquoise">
                <div class="content">
                    <p>Total </p>
                    <h1 class="text-left timer" data-from="0" data-to="{{$judge_count}}" data-speed="2500"> </h1>
                    <p>of Line Judges</p>
                </div>
                <div class="icon"><i class="fa fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="dashboard-tile detail tile-blue">
                <div class="content">
                    <p>Total</p>
                    <h1 class="text-left timer" data-from="0" data-to="{{$user_count}}" data-speed="2500"> </h1>
                    <p>of Users</p>
                </div>
                <div class="icon"><i class="fa fa-user"></i>
                </div>
            </div>
        </div>
    </div>
    <!--tiles end-->

    <!--dashboard charts and map start-->
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-solid-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Types of Events</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down"></i>
                        <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <table class="table table-responsive data-table">
                        <thead>
                        <tr>
                            <th>Season</th>
                            @foreach($event_levels as $event_level)
                                <th>{{$event_level->event_level_name}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events_by_seasons as $season=>$event_season)
                            <tr>
                                @php
                                    $total = 0;
                                @endphp
                                <td>{{$season}}</td>
                                @foreach($event_season as $event)
                                    <td>{{$event->count}}</td>
                                    @php
                                        $total+=$event->count;
                                    @endphp
                                @endforeach
                                <td>{{$total}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-solid-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Active Membership Analysis</h3>
                            <div class="actions pull-right">
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <div class="panel-body text-center">
                            <table class="table table-responsive">
                                <tbody>
                                @foreach($count_by_skilllvl as $skilllvl)
                                    <tr>
                                        <td>{{$skilllvl->level_name}}</td>
                                        <td>{{$skilllvl->count}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-solid-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Line Judge Demographics</h3>
                            <div class="actions pull-right">
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <div class="panel-body text-center">
                            <table class="table table-responsive">
                                <tbody>
                                @foreach($demographics as $key => $row)
                                    @foreach(json_decode(json_encode($row), true) as $range=>$result)
                                        <tr>
                                            <td>{{$range}}</td>
                                            <td>{{$result}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--dashboard charts and map end-->

@stop

@section("script")

    <!--Page Leve JS -->
    <script src="{{url('resources/assets/plugins/chartjs/Chart.min.js')}}"></script>

    <script>
        $(function () {

            app.timer();

            var doughnutData = [
                {value: {{$event_count}}, color: "#3598db"},
                {value: {{$game_count}}, color: "#9a59b5"},
            ];
            var myDoughnut = new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);

            var barChartData = {
                labels: [""],
                datasets: [
                    {
                        fillColor: "rgba(53,152,219,0.5)",
                        strokeColor: "rgba(48,133,190,1)",
                        data: [{{$event_count}}]
                    },
                    {
                        fillColor: "rgba(154,89 ,181,0.5)",
                        strokeColor: "rgba(137,74,164,1)",
                        data: [{{$game_count}}]
                    }
                ]

            }

            var myLine = new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
        });
    </script>
@stop