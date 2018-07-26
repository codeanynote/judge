
@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li>Judges</li>
                <li class="active active-title">Add a Line Judge</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add a new Line Judge</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal form-border" action="{{route('judge.create')}}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label" >First Name*</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" required name="first_name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Surname*</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" required name="sur_name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">DOB</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datepicker" name="dob">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address Line1</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="address_line1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address Line2</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="address_line2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address Line3</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="address_line3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">City</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="city">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Post Code</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="post_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Country</label>
                            <div class="col-sm-6">
                                <select name="country" class="form-control">
                                    @foreach ($country_list as $country )
                                        <option value="{{$country->country_id}}">{{$country->country_name}}</option>
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
                                        <option value="{{$region->region_id}}">{{$region->region_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Home Phone</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="home_phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mobile Phone</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="mobile_phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Skills Level</label>
                            <div class="col-sm-6">

                                <select name="skills_level" class="form-control" style="width: 60px"  data-id="">
                                    @foreach($skill_list as $skill)
                                        <option value="{{$skill->level_id}}">{{$skill->level_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Skills Level Achieved Date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datepicker" name="skills_level_achieved">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Active Member</label>
                            <div class="col-sm-6">
                                <select name="active" class="form-control judge_active" style="width: 60px"  data-id="">
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Membership Paid Up</label>
                            <div class="col-sm-6">
                                <select name="membership_paid_up" class="form-control judge_active" style="width: 60px"  data-id="">
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Membership Expiry Date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datepicker" name="membership_expiry_date">
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <label class="col-sm-3 control-label">Member Ship</label>
                            <div class="col-sm-6">
                                <div class="radio radio-inline">
                                    <input class="" type="radio" name="member_ship" value="1">
                                    <label>Free Member</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input class="" type="radio" checked  name="member_ship" value="2">
                                    <label>Associate Member</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input class="" type="radio" name="member_ship" value="3">
                                    <label>Non Member</label>
                                </div>
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
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection