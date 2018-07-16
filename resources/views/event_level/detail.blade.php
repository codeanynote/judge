
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Event Levels</li>
            <li class="active active-title">Event Level Detail</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail Of {{$event_level->event_level_name}}</h3>
            </div>
            <div class="panel-body form-horizontal  detail-form" style="overflow: hidden;">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Event Level: </label>
                        <span  class="form-control border-none">{{$event_level->event_level_name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop