
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Events</li>
            <li class="active active-title">Event Detail</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail Of {{$event->event_name}}</h3>
            </div>
            <div class="panel-body form-horizontal  detail-form" style="overflow: hidden;">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Event Number: </label>
                        <span class="form-control border-none">E{{substr($event->year, 2).$event->event_number}} </span>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Event Name: </label>
                        <span  class="form-control border-none">{{$event->event_name}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Year: </label>
                        <span  class="form-control border-none">{{$event->year}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Season: </label>
                        <span class="form-control border-none"> {{$event->season}} </span>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Start Date: </label>
                        <span class="form-control border-none"> {{date("d/m/Y", strtotime($event->event_start_date))}} </span>
                    </div>      
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Finish Date: </label>
                        <span class="form-control border-none"> {{date("d/m/Y", strtotime($event->event_finish_date))}} </span>
                    </div>                         
                </div>
                <div class="row">          
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Event Level: </label>
                        <span class="form-control border-none">
                            {{$event->get_event_level->event_level_name}} 
                        </span>
                    </div> 
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Event in England & Wales: </label>
                        <span class="form-control border-none"> {{$event->event_in_uk}} </span>
                    </div>              
                </div>                

            </div>
        </div>
    </div>
</div>
@stop