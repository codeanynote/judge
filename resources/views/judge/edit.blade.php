
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Judges</li>
            <li class="active active-title">Edit Line Judge</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Form Judge</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal form-border" action="{{route('judge.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="judge_id" value="{{$judge->judge_id}}"/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >First Name*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="first_name" value="{{$judge->first_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Surname*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="sur_name" value="{{$judge->sur_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email" value="{{$judge->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">DOB</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" name="dob" value="{{date("d/m/Y", strtotime($judge->dob))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address Line1</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="address_line1" value="{{$judge->address_line1}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address Line2</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="address_line2" value="{{$judge->address_line2}}">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address Line3</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="address_line3" value="{{$judge->address_line3}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">City</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="city" value="{{$judge->city}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Post Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="post_code" value="{{$judge->post_code}}">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-6">
                            <select name="country" class="form-control">
                                @foreach ($country_list as $country)
                                    <option value="{{$country->country_id}}" @if($judge->country==$country->country_id) selected @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Region</label>
                        <div class="col-sm-6">
                            <select name="region" class="form-control">
                                <option value="0">N/A</option>
                                @foreach ($region_list as $region)
                                    <option value="{{$region->region_id}}" @if($region->region_id==$judge->region) selected @endif>{{$region->region_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Home Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="home_phone" value="{{$judge->home_phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mobile Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="mobile_phone" value="{{$judge->mobile_phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Skills Level</label>
                        <div class="col-sm-6">
                            <select name="skills_level" class="form-control" style="width: 60px"  data-id="">
                                @foreach($skill_list as $skill)
                                    <option @if($judge->skills_level==$skill->level_id) selected @endif value="{{$skill->level_id}}">{{$skill->level_name}}</option>
                                @endforeach
                            </select>          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Skills Level Achieved Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" name="skills_level_achieved" value="{{date("d/m/Y", strtotime($judge->skills_level_achieved))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Membership Expiry Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" name="membership_expiry_date" value="{{date("d/m/Y", strtotime($judge->membership_expiry_date))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">membership_paid_up</label>
                        <div class="col-sm-6">
                            <select name="membership_paid_up" class="form-control membership_paid_up" style="width: 60px"  data-id="">
                                <option value="1" @if($judge->membership_paid_up==1) selected @endif>Y</option>
                                <option value="0" @if($judge->membership_paid_up==0) selected @endif>N</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Active Member</label>
                        <div class="col-sm-6">
                            <select name="active" class="form-control judge_active" style="width: 60px"  data-id="">
                                <option value="1" @if($judge->active==1) selected @endif>Y</option>
                                <option value="0" @if($judge->active==0) selected @endif>N</option>
                            </select>
                        </div>
                    </div>
                    <!--                    <div class="form-group hidden">
                                            <label class="col-sm-3 control-label">Member Ship</label>
                                            <div class="col-sm-6">
                                                <div class="radio radio-inline">
                                                    <input class="" type="radio" name="member_ship" @if($judge->member_ship=='1') checked @endif value="1">
                                                    <label>Free Member</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input class="" type="radio" name="member_ship" @if($judge->member_ship=='2') checked @endif value="2">
                                                    <label>Associate Member</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input class="" type="radio" name="member_ship" @if($judge->member_ship=='3') checked @endif value="3">
                                                    <label>Non Member</label>
                                                </div>
                                            </div>
                                        </div>-->
                    <div class="col-sm-6 col-sm-offset-3 text-right">
                        <button class="btn btn-info" type="submit">Save</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@stop