
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Events</li>
            <li class="active active-title">Edit Event</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Form Event</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal form-border" action="{{route('event.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="event_id" value="{{$event->event_id}}"/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Event Name*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="event_name" value="{{$event->event_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Year</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" readonly id="year" name="year" value="{{$event->year}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Season</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required readonly id="season" name="season" value="{{$event->season}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Start Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" required id="event_start_date" name="event_start_date" value="{{date("d/m/Y", strtotime($event->event_start_date))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Finish Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" required id="event_finish_date" name="event_finish_date" value="{{date("d/m/Y", strtotime($event->event_finish_date))}}">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Level</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="event_level">
                                @foreach ($event_level_list as $event_level)
                                    <option value="{{$event_level->event_level_id}}" @if($event->event_level==$event_level->event_level_id) selected @endif>{{$event_level->event_level_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event in England & Wales</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="event_in_uk">
                                <option value="Yes" @if($event->event_in_uk=='Yes') selected @endif>Yes</option>
                                <option value="No" @if($event->event_in_uk=='No') selected @endif>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3 text-right">
                        <button class="btn btn-info">Save</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    $(function () {
        $('#event_start_date').change(function () {
            var date = new Date($(this).val());
            var year = date.getFullYear();
            $('#year').val(year);
            $('#season').val(year + '-' + Number(year + 1));
        });
    });
</script>
@stop