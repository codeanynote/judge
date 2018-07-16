
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Event Level</li>
            <li class="active active-title">Edit Event Level</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Form Event Level</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal form-border" action="{{route('event_level.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="event_level_id" value="{{$event_level->event_level_id}}"/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Level</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="event_level_name" name="event_level_name" value="{{$event_level->event_level_name}}">
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

    });
</script>
@stop