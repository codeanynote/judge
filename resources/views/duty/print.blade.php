
@extends('print_master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">
<style>

    #dutyTable{
        margin-top:30px;
    }

    #dutyTable td.chk_duty{
        background-size:15px;
        background-repeat:no-repeat;
        background-position: center;
    }
    #dutyTable tr:nth-child(1) th:nth-child(2){
        min-width: 100px;
    }

    th.rotate {
        position: relative;
        padding: 10px !important;
        height: 150px!important;
    }
</style>
@stop
@section('content')
<table id="dutyTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="4">LJ Number</th>
            <th rowspan="4">LJ Name</th>
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
            <th class="rotate" title="{{$event->event_start_date.' ~ '.$event->event_finish_date}}">
                <span>{{$event->event_start_date.' ~ '.$event->event_finish_date}}</span>
            </th>
            @endforeach
            @endforeach
        </tr>
        <tr>
            @foreach ($event_season_list as $i=>$season)
            @foreach($event_event_list[$i] as $k=>$event)
            <th title="{{$event->event_start_date.' ~ '.$event->event_finish_date}}">
                {{$event->event_level=='1'?'L':($event->event_level=='2'?'R':($event->event_level=='3'?'N':'I'))}}
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
            <td align="center" class="chk_duty {{$duty->season}}-{{$duty->event_level}}" style="{{isset($duty->duty_id)?'background-image:url('.url('resources/assets/img/Check-Free_Use.png').')':''}}" title="{{$duty->event_start_date}} ~ {{$duty->event_finish_date}}">
                <!--<input type="checkbox" data-level="{{$duty->event_level}}" data-season="{{$duty->season}}"  data-judge="{{$duty->judge_id}}" data-event="{{$duty->event_id}}" class="duty_value hidden" value="{{$duty->judge_id.'_'.$duty->event_id}}" {{isset($duty->duty_id)?'checked':''}}>-->
            </td>                                       
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('script')
<!--Page Leve JS -->
<script src="{{url('resources/assets/plugins/dataTables/js/jquery.dataTables.js')}}"></script>
<script src="{{url('resources/assets/plugins/dataTables/js/dataTables.bootstrap.js')}}"></script>
<script>
window.onload = function () {
window.print();
}
$(function () {

$('#dutyTable tr').each(function(){
calcTotalCount($(this));
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
        if (data.message == 'ok'){
        if (obj.prop('checked'))
                obj.parents('td').css('background-image', 'url({{url('resources / assets / img / Check - Free_Use.png')}})');
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
function calcSumCountOfSeason(obj, value){
var season = obj.attr('data-season');
var event_level = obj.attr('data-level');
var count = obj.parents('tr').find('.t-' + season + '-' + event_level).text();
if (value)
        count++;
else
        count--;
obj.parents('tr').find('.t-' + season + '-' + event_level).text(count);
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