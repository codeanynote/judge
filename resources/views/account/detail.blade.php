
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Accounts</li>
            <li class="active active-title">Account Detail</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail Of {{$account->username}}</h3>
            </div>
            <div class="panel-body form-horizontal  detail-form" style="overflow: hidden;">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Account Number: </label>
                        <span class="form-control border-none">{{$account->userid}} </span>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Event Name: </label>
                        <span  class="form-control border-none">{{$account->username}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Email: </label>
                        <span  class="form-control border-none">{{$account->email}}</span>
                    </div>            
                </div>              

            </div>
        </div>
    </div>
</div>
@stop