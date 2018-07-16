
@extends('print_master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">
@stop
@section('content')

<table id="eventTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Event Number</th>
            <th>Event Name</th>
            <th>Year</th>
            <th>Season</th>
            <th>Start Date</th>
            <th>Finish Date</th>
            <th>Event Level</th>
            <th>Event in England & Wales</th>
        </tr>
    </thead>

    <tbody>
        @foreach($events as $key=>$event)
        <tr>
            <td nowrap align="right">E{{substr($event->year, 2).$event->event_number}}</td>
            <td nowrap>{{$event->event_name}}</td>
            <td nowrap>{{$event->year}}</td>
            <td nowrap>{{$event->season}}</td>
            <td nowrap>{{$event->event_start_date}}</td>
            <td nowrap>{{$event->event_finish_date}}</td>
            <td nowrap>{{$event->event_level=='1'?'Regional':($event->event_level=='2'?'National':'InterNational')}}</td>
            <td nowrap align="center">{{$event->event_in_uk}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@stop

@section('script')
<!--Page Leve JS -->
<script src="{{url('resources/assets/plugins/dataTables/js/jquery.dataTables.js')}}"></script>
<script src="{{url('resources/assets/plugins/dataTables/js/dataTables.bootstrap.js')}}"></script>
@stop