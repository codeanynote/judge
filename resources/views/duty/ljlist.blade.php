
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
            <li class="active active-title">Line Judge Duty</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="col-sm-3"><h3 class="panel-title">Duty Table</h3></div>
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
                                <th colspan="2">Season</th>
                                @foreach($event_season_list as $i=>$season)
                                    <th colspan="{{sizeof($event_event_list[$i])}}">{{$season->season}}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th colspan="2">Event Name</th>
                                @foreach ($event_season_list as $i=>$season)
                                    @foreach($event_event_list[$i] as $k=>$event)
                                        <th class="rotate" title="{{$event->event_name}}">
                                            <span>{{$event->event_name}}</span>
                                        </th>
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th colspan="2">Event Dates</th>
                                @foreach ($event_season_list as $i=>$season)
                                    @foreach($event_event_list[$i] as $k=>$event)
                                        <th class="rotate" title="{{date("d/m/Y", strtotime($event->event_start_date)).' ~ '.date("d/m/Y", strtotime($event->event_finish_date))}}">
                                            <span>{{date("d/m/Y", strtotime($event->event_start_date)).' ~ '.date("d/m/Y", strtotime($event->event_finish_date))}}</span>
                                        </th>
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th colspan="2">Event Level</th>
                                @foreach ($event_season_list as $i=>$season)
                                    @foreach($event_event_list[$i] as $k=>$event)
                                        <th title="{{$event->event_start_date.' ~ '.$event->event_finish_date}}">
                                            <span>{{$event->event_level=='1'?'L':($event->event_level=='2'?'R':($event->event_level=='3'?'N':'I'))}}</span>
                                        </th>
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th colspan="2">Event Duration</th>
                                @foreach ($event_season_list as $i=>$season)
                                    @foreach($event_event_list[$i] as $k=>$event)
                                        <th>
                                            @php
                                                $datetime1 = date_create($event->event_start_date);
                                                $datetime2 = date_create($event->event_finish_date);
                                                
                                                $interval = date_diff($datetime1, $datetime2);
                                            @endphp
                                            <span>{{$interval->format('%a')}}</span>
                                        </th>
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>LJ Number</th>
                                <th>LJ Name</th>
                                @foreach ($event_season_list as $i=>$season)
                                    @foreach($event_event_list[$i] as $k=>$event)
                                        <th>
                                        </th>
                                    @endforeach
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($judge_list as $i=>$judge)
                            <tr>
                                <td>LJ{{$judge->judge_id<10?'00'.$judge->judge_id:($judge->judge_id<100?'0'.$judge->judge_id:$judge->judge_id)}}</td>
                                <td>{{$judge->first_name.' '.$judge->sur_name}}</td>
                                @foreach($judge->duty as $j=>$duty) 
                                
                                    <td align="center" class="chk_duty {{$duty->season}}-{{$duty->event_level}}" style="{{isset($duty->duty_id)?'':''}}" title="{{$duty->event_start_date}} ~ {{$duty->event_finish_date}}">
                                        @if(isset($duty->start_date) && isset($duty->finish_date) )
                                        <img src="{{url('resources/assets/img/Check-Free_Use.png')}}" alt="">
                                            @php
                                                $start_date = Carbon\Carbon::parse($duty->start_date);
                                                $finish_date = Carbon\Carbon::parse($duty->finish_date);
                                                $days = $start_date->diffInDays($finish_date, false);
                                                echo $days;
                                            @endphp
                                        @endif 
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

    $('input[type=search]:not(.evt-search)').on('keyup', function (e) {
        $('#dutyTable th, #dutyTable td').show();
    });

    setSeasonColspan();  
    
    $('#dutyTable_filter input[type=search]').attr('placeholder', 'Line Judge');

    $('#dutyTable_filter').prepend('<label><input class="form-control evt-search" placeholder="Event" style="margin-left:10px; margin-right:10px;"/></label>');
    $('.evt-search').width($('input[type=search]').width()).on('keyup', function (e) {

        search_text = $(this).val().toLowerCase();
        var total_cols = [];
        var result_cols = [];

        resetSeasonColspan();
        $('#dutyTable th, #dutyTable td').show();

        if (search_text != '') {
            $('#dutyTable thead tr').eq(1).find('th span').each(function () {
                total_cols.push($(this).parent().index());
                if (($(this).text().toLowerCase().indexOf(search_text)) > -1){
                    result_cols.push($(this).parent().index());
                }
                    
            });

            result_cols = diff = total_cols.filter(x => result_cols.indexOf(x) < 0 );
            for(var i = 0; i < result_cols.length; i ++){
                decSeasonColspan(result_cols[i]);
            }

            $('#dutyTable thead tr:nth-child(2) th, #dutyTable thead tr:nth-child(3) th, #dutyTable thead tr:nth-child(4) th').each(function(){
                var col = $(this).index();
                if(result_cols.includes(col)){
                    $(this).hide();
                    // $(this).find('span').hide();
                    // $(this).width(0);
                    // $(this).css({'border': '0', 'padding':0});
                }
            });
            $('#dutyTable tbody tr').each(function(){
                $(this).children('td').each(function(){
                    var col = $(this).index();
                    if(result_cols.includes(col - 2)){
                        $(this).hide();
                        // $(this).width(0);
                        // $(this).css({ 'padding':0});
                    }
                });
            });           

        }
    });

    $('#dutyTable tr').each(function(){
        calcTotalCount($(this));            
    });

    $(document).delegate('.chk_duty', 'click', function(){
        $(this).find('input[type=checkbox]').click();
    });        

    $('.btn-down').click(function(){           
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();
        location.href = '{{route("duty.export")}}?from_year='+from_year+'&to_year='+to_year;
    });
    
    $('.btn-print').click(function(){         
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();        
        window.open('{{route("duty.print")}}?from_year='+from_year+'&to_year='+to_year);
    });

    $(document).delegate('.duty_value', 'change', function(){
        var obj = $(this);
        $.ajax({
            type: "get",                
            url: '{{route('duty.update')}}',
            data:{
                judge_id: obj.attr('data-judge'),
                event_id: obj.attr('data-event'),
                value: obj.prop('checked'),
            },
            success: function (data) {  
                if(data.message == 'ok'){
                    if(obj.prop('checked'))
                        obj.parents('td').css('background-image', 'url({{url('resources/assets/img/Check-Free_Use.png')}})');
                    else
                        obj.parents('td').css('background-image', 'none');

                    calcSumCountOfSeason(obj, obj.prop('checked'));
                }
            },
            error: function (req, text, error) {
            },
            dataType: "json",
        });
    });
    
    $('select[name=from_year]').change(function(){        
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();
        
        if(from_year <= to_year)        
            location.href = '{{route("duty.index")}}?from_year='+from_year+'&to_year='+to_year;
        else{
            $('select[name=from_year] option[value={{$from_year}}]').prop('selected', true);
            $('select[name=to_year] option[value={{$to_year}}]').prop('selected', true);
        }
    });

    $('select[name=to_year]').change(function(){
        var from_year = $('select[name=from_year]').val();
        var to_year = $('select[name=to_year]').val();
        if(from_year <= to_year)        
            location.href = '{{route("duty.index")}}?from_year='+from_year+'&to_year='+to_year;
        else{
            $('select[name=from_year] option[value={{$from_year}}]').prop('selected', true);
            $('select[name=to_year] option[value={{$to_year}}]').prop('selected', true);
        }
    });
    
    $('#dutyTable tbody tr').click(function(){
        $('#dutyTable tbody tr').removeClass('back-white-gray');
        $(this).addClass('back-white-gray');
    });
});

var colspan_arr = [];
var col_arr = [];

function setSeasonColspan(){
    var n = 0;
    $('#dutyTable thead tr:nth-child(1) th:gt(1)').each(function(){
        colspan_arr.push($(this).attr('colspan'));
        var cols = [];
        for(var i = 0; i < $(this).attr('colspan'); i++){
            cols.push(n);
            n++;
        }
        col_arr.push(cols);
    });
}

function resetSeasonColspan(){
    $('#dutyTable thead tr:nth-child(1) th:gt(1)').each(function(){
        var col = $(this).index() - 2;
        $(this).attr('colspan', colspan_arr[col]);
    });
}

function decSeasonColspan(index){
    $('#dutyTable thead tr:nth-child(1) th:gt(1)').each(function(){
        var colspan = $(this).attr('colspan');
        var col = $(this).index() - 2;
        if(col_arr[col].includes(index)){
            $(this).attr('colspan', colspan - 1);
            if($(this).attr('colspan') < 1)
                $(this).hide();
        }
    });
}

function calcSumCountOfSeason(obj, value){
    var season = obj.attr('data-season');
    var event_level = obj.attr('data-level');
    var count = obj.parents('tr').find('.t-'+season+'-'+event_level).text();
    if(value)
        count++;
    else
        count--;
    obj.parents('tr').find('.t-'+season+'-'+event_level).text(count);
    calcTotalCount(obj.parents('tr'));
}

function calcTotalCount(obj){
    var total = 0;
    obj.find('td.sum').each(function(){
        total += Number($(this).text());
    });
    obj.find('.total').text(total);
}
</script>
@stop