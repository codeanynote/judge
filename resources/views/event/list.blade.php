
@extends('master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Events</li>
            <li class="active active-title">View Events</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List of All Events</h3>
                <div class="actions pull-right">
                    <a class="btn-down" href="{{route('event.export')}}"><i class="fa fa-download" style="font-size:20px"></i></a>
                    <a class="btn-print" href="{{route('event.print')}}" target="new"><i class="fa fa-print" style="font-size:20px"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
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
                                <th>Event in <br>England & Wales</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($events as $key=>$event)
                            <tr>
                                <td nowrap align="right">E{{str_pad($event->event_id, 4, "0", STR_PAD_LEFT)}}</td>
                                <td nowrap>{{$event->event_name}}</td>
                                <td nowrap>{{$event->year}}</td>
                                <td nowrap>{{$event->season}}</td>
                                <td nowrap>{{date("d/m/Y", strtotime($event->event_start_date))}}</td>
                                <td nowrap>{{date("d/m/Y", strtotime($event->event_finish_date))}}</td>
                                <td nowrap>
                                    {{$event->get_event_level->event_level_name}}
                                </td>
                                <td nowrap align="center">{{$event->event_in_uk}}</td>
                                <td nowrap>
                                    <a class="btn btn-info btn-sm" href="{{route('event.detail', $event->event_id)}}">View</a>
                                    <a class="btn btn-primary btn-sm" href="{{route('event.edit', $event->event_id)}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal_{{$event->event_id}}">Delete</a>
                                    <!-- Confirm Modal -->
                                    <div class="modal fade" id="confirmModal_{{$event->event_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Confirm Modal</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure delete?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <a type="button" class="btn btn-primary" href="{{route('event.delete', $event->event_id)}}">Confirm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Confirm Modal -->
                                </td>
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
    $('#eventTable').dataTable();
});
</script>
@stop