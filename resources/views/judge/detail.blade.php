
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Judges</li>
            <li class="active active-title">Line Judge Detail</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Information Of {{$judge->first_name.'  '.$judge->sur_name}}</h3>
            </div>
            <div class="panel-body form-horizontal  detail-form" style="overflow: hidden;">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">LJ Number: </label>
                        <span class="form-control border-none"> LJ{{$judge->judge_id<10?'00'.$judge->judge_id:($judge->judge_id<100?'0'.$judge->judge_id:$judge->judge_id)}} </span>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Firstname: </label>
                        <span  class="form-control border-none">{{$judge->first_name}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Surname: </label>
                        <span  class="form-control border-none">{{$judge->sur_name}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">E-mail Address: </label>
                        <span class="form-control border-none"> {{$judge->email}} </span>
                    </div>         
                    
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">DOB: </label>
                        <span class="form-control border-none"> {{date("d/m/Y", strtotime($judge->dob))}} </span>
                    </div>         
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">Address Line1: </label>
                        <span class="form-control border-none"> {{$judge->address_line1}} </span>
                    </div>      
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">Address Line2: </label>
                        <span class="form-control border-none"> {{$judge->address_line2}} </span>
                    </div>           
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">Address Line3: </label>
                        <span class="form-control border-none"> {{$judge->address_line3}} </span>
                    </div>                         
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">City: </label>
                        <span class="form-control border-none"> {{$judge->city}} </span>
                    </div>      
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">Post Code: </label>
                        <span class="form-control border-none"> {{$judge->post_code}} </span>
                    </div>           
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">Country: </label>
                        <span class="form-control border-none"> {{$judge->country}} </span>
                    </div>                         
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label col-sm-6 text-right">Region: </label>
                        <span class="form-control border-none"> {{$judge->region_name?$judge->region_name:'N/A'}} </span>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Home Phone: </label>
                        <span  class="form-control border-none">{{$judge->home_phone}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Mobile Phone: </label>
                        <span  class="form-control border-none">{{$judge->mobile_phone}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Skills Level: </label>
                        <span  class="form-control border-none">{{$judge->level_name}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Skills Level Achieved Date: </label>
                        <span  class="form-control border-none">{{date("d/m/Y", strtotime($judge->skills_level_achieved))}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">Membership Expiry Date: </label>
                        <span  class="form-control border-none">{{date("d/m/Y", strtotime($judge->membership_expiry_date))}}</span>
                    </div>
                </div>
<!--                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label col-sm-4 text-right">LJ Number: </label>
                        <span class="form-control border-none"> {{$judge->member_ship==1?'Free member':($judge->member_ship==2?'Associate member':'Non member')}} </span>
                    </div>                    
                </div>-->

            </div>
        </div>
    </div>
</div>
@stop