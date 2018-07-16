
@extends('master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">
<style>

    #dutyTable td.chk_duty{
        background-size:15px;
        background-repeat:no-repeat;
        background-position: center;
    }
    #dutyTable tr:nth-child(1) th:nth-child(2){
        min-width: 100px;
    }
</style>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Duty</li>
            <li class="active active-title">Event Coverage</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="col-sm-3"><h3 class="panel-title">Event Report</h3></div>
                <div class="col-sm-8 form-horizontal">
                    <label class="col-sm-1 control-label">from</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="from_year">
                            @foreach($years as $key=>$year)
                            <option value="{{$year->year}}" @if($from_year==$year->year) selected @endif>{{$year->year}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-sm-1 control-label">to</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="to_year">
                            @foreach($years as $key=>$year)
                            <option value="{{$year->year}}" @if($to_year==$year->year) selected @endif>{{$year->year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="actions pull-right">
                    <a class="btn-down"><i class="fa fa-download" style="font-size:20px"></i></a>
                    <a class="btn-print"><i class="fa fa-print" style="font-size:20px"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="dutyTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="3">LJ Level</th>
                                @foreach($event_season_list as $i=>$season)
                                <th colspan="{{sizeof($event_event_list[$i])}}">{{$season->season}}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($event_season_list as $i=>$season)
                                @foreach($event_event_list[$i] as $k=>$event)
                                <th class="rotate" title="{{$event->event_name}}">
                                    <span>{{$event->event_name}}</span>
                                </th>
                                @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($event_season_list as $i=>$season)
                                @foreach($event_event_list[$i] as $k=>$event)
                                <th title="{{date("d/m/Y", strtotime($event->event_start_date)).' ~ '.date("d/m/Y", strtotime($event->event_finish_date))}}">
                                    {{$event->event_level=='1'?'L':($event->event_level=='2'?'R':($event->event_level=='3'?'N':'I'))}}
                                </th>
                                @endforeach
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            <tr>                                
                                <td>Total LJs</td>
                                @foreach($event_list as $event)
                                <td class="text-right">
                                    {{$event->total->count}}
                                </td>
                                @endforeach
                            </tr>

                            @foreach($level_list as $i=>$level)
                            <tr>
                                <td>{{$level->level_name}}</td>
                                @foreach($level->duty as $j=>$duty)   
                                <td class="text-right">
                                    {{$duty->count==0?'':$duty->count}}
                                </td>                                       
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('script')
<!--Page Leve JS -->
<script src="{{url('resources/assets/plugins/dataTables/js/jquery.dataTables.js')}}"></script>
<script src="{{url('resources/assets/plugins/dataTables/js/dataTables.bootstrap.js')}}"></script>
<script>
$(function () {
    $('#dutyTable').dataTable({
        "ordering": false
    });
    $('#dutyTable_filter label').remove();

    $('#dutyTable_filter').prepend('<label class="control-label" style=margin-top:7px;>Search: <input class="form-control evt-search" placeholder="Event" style="margin-left:10px; margin-right:10px;"/></label>');
    $('.evt-search').width($('input[type=search]').width()).on('keyup', function (e) {

        search_text = $(this).val().toLowerCase();
        $('#dutyTable thead tr').eq(1).find('th span').css('background-color', '#fff');
        if (search_text != '') {
            $('#dutyTable thead tr').eq(1).find('th span').each(function () {
                if (($(this).text().toLowerCase().indexOf(search_text)) > -1)
                    $(this).css('background-color', '#ff0').focus();
            });
        }
    });

    $('#dutyTable tbody tr').click(function () {
        $('#dutyTable tbody tr').removeClass('back-white-gray');
        $(this).addClass('back-white-gray');
    });

    $('.btn-down').click(function () {
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();
        location.href = '{{route("duty.event.export")}}?from_year=' + from_year + '&to_year=' + to_year;
    });

    $('.btn-print').click(function () {
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();
        window.open('{{route("duty.event.print")}}?from_year=' + from_year + '&to_year=' + to_year);
    });

    $('select[name=from_year]').change(function () {
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();

        if (from_year <= to_year)
            location.href = '{{route("duty.event")}}?from_year=' + from_year + '&to_year=' + to_year;
        else {
            $('select[name=from_year] option[value={{$from_year}}]').prop('selected', true);
            $('select[name=to_year] option[value={{$to_year}}]').prop('selected', true);
        }
    });

    $('select[name=to_year]').change(function () {
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();
        if (from_year <= to_year)
            location.href = '{{route("duty.event")}}?from_year=' + from_year + '&to_year=' + to_year;
        else {
            $('select[name=from_year] option[value={{$from_year}}]').prop('selected', true);
            $('select[name=to_year] option[value={{$to_year}}]').prop('selected', true);
        }
    });
});
</script>
@stop