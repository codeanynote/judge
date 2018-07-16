
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
            <li>Judges</li>
            <li class="active active-title">View Line Judges</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List of All Line Judges</h3>
                <div class="actions pull-right">
                    <a class="btn-down" href="{{route('judge.export')}}"><i class="fa fa-download" style="font-size:20px"></i></a>
                    <a class="btn-print" href="{{route('judge.print')}}" target="new"><i class="fa fa-print" style="font-size:20px"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="ljtable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>LJ Number</th>
                                <th>Firstname</th>
                                <th>Surname</th>
                                <th>Email Address</th>
                                <th>DOB</th>
                                <th>Address line1</th>
                                <th>Address line2</th>
                                <th>Address line3</th>
                                <th>City</th>
                                <th>Post Code</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>Home Phone</th>
                                <th>Mobile Phone</th>
                                <th>Skills Level</th>
                                <th>Skills Level Achieved Date</th>
                                <th>Membership Expiry Date</th>
                                <th>MemberShip Paid Up</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($judges as $key=>$judge)
                            <tr>
                                <td nowrap>LJ{{$judge->judge_id<10?'00'.$judge->judge_id:($judge->judge_id<100?'0'.$judge->judge_id:$judge->judge_id)}}</td>
                                <td nowrap>{{$judge->first_name}}</td>
                                <td nowrap>{{$judge->sur_name}}</td>
                                <td nowrap>{{$judge->email}}</td>
                                <td nowrap>{{date("d/m/Y", strtotime($judge->dob))}}</td>
                                <td nowrap>{{$judge->address_line1}}</td>
                                <td nowrap>{{$judge->address_line2}}</td>
                                <td nowrap>{{$judge->address_line3}}</td>
                                <td nowrap>{{$judge->city}}</td>
                                <td nowrap>{{$judge->post_code}}</td>
                                <td nowrap>{{$judge->country_name}}</td>
                                <td nowrap>{{$judge->region_name?$judge->region_name:'N/A'}}</td>
                                <td nowrap>{{$judge->home_phone}}</td>
                                <td nowrap>{{$judge->mobile_phone}}</td>
                                <td nowrap>{{$judge->level_name}}</td>
                                <td nowrap>{{date("d/m/Y", strtotime($judge->skills_level_achieved))}}</td>
                                <td nowrap>{{date("d/m/Y", strtotime($judge->membership_expiry_date))}}</td>
                                <td>
                                    <!-- <input type='checkbox' name="active" readonly value="1"  @if($judge->active==1) checked @endif class='ios8-switch ios8-switch-sm pull-right judge_active' data-id="{{$judge->judge_id}}" id='is_active_{{$judge->judge_id}}'>
                                    <label for='is_active_{{$judge->judge_id}}' class="pull-right">&nbsp;</label> -->

                                    <select class="form-control membership_paid_up"  data-id="{{$judge->judge_id}}">
                                        <option value="1" @if($judge->membership_paid_up==1) selected @endif>Y</option>
                                        <option value="0" @if($judge->membership_paid_up==0) selected @endif>N</option>
                                    </select>
                                </td>
                                <td>
                                    <!-- <input type='checkbox' name="active" readonly value="1"  @if($judge->active==1) checked @endif class='ios8-switch ios8-switch-sm pull-right judge_active' data-id="{{$judge->judge_id}}" id='is_active_{{$judge->judge_id}}'>
                                    <label for='is_active_{{$judge->judge_id}}' class="pull-right">&nbsp;</label> -->

                                    <select class="form-control judge_active"  data-id="{{$judge->judge_id}}">
                                        <option value="1" @if($judge->active==1) selected @endif>Y</option>
                                        <option value="0" @if($judge->active==0) selected @endif>N</option>
                                    </select>
                                </td>
                                <td nowrap>
                                    <a class="btn btn-info btn-sm" href="{{route('judge.detail', $judge->judge_id)}}">View</a>
                                    <a class="btn btn-primary btn-sm" href="{{route('judge.edit', $judge->judge_id)}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal_{{$judge->judge_id}}">Delete</a>
                                    <!-- Confirm Modal -->
                                    <div class="modal fade" id="confirmModal_{{$judge->judge_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a type="button" class="btn btn-primary" href="{{route('judge.delete', $judge->judge_id)}}">Confirm</a>
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
    $('#ljtable').dataTable();
    
    $('.judge_active').change(function(){
        location.href="{{url('judge/active')}}/" + $(this).attr('data-id')+'/'+$(this).val();
    });

    $('.membership_paid_up').change(function(){
        location.href="{{url('judge/membership_paid_up')}}/" + $(this).attr('data-id')+'/'+$(this).val();
    });
});
</script>
@stop