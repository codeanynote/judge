
@extends('print_master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">
@stop
@section('content')

<table id="ljtable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>LJ Number</th>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Email Address</th>
            <th>Address line1</th>
            <th>Address line2</th>
            <th>Address line3</th>
            <th>City</th>
            <th>Post Code</th>
            <th>Country</th>
            <th>Home Phone</th>
            <th>Mobile Phone</th>
            <th>Skills Level</th>
            <th>Skills Level Achieved Date</th>
            <!--<th>Membership</th>-->
        </tr>
    </thead>

    <tbody>
        @foreach($judges as $key=>$judge)
        <tr>
            <td nowrap>LJ{{$judge->judge_id<10?'00'.$judge->judge_id:($judge->judge_id<100?'0'.$judge->judge_id:$judge->judge_id)}}</td>
            <td nowrap>{{$judge->first_name}}</td>
            <td nowrap>{{$judge->sur_name}}</td>
            <td nowrap>{{$judge->email}}</td>
            <td nowrap>{{$judge->address_line1}}</td>
            <td nowrap>{{$judge->address_line2}}</td>
            <td nowrap>{{$judge->address_line3}}</td>
            <td nowrap>{{$judge->city}}</td>
            <td nowrap>{{$judge->post_code}}</td>
            <td nowrap>{{$judge->get_country->country_name}}</td>
            <td nowrap>{{$judge->home_phone}}</td>
            <td nowrap>{{$judge->mobile_phone}}</td>
            <td nowrap>{{$judge->get_skill_level->level_name}}</td>
            <td nowrap>{{$judge->skills_level_achieved}}</td>
            <!--<td nowrap>{{$judge->member_ship==1?'Free member':($judge->member_ship==2?'Associate member':'Non member')}}</td>-->
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('script')
<!--Page Leve JS -->
<script src="{{url('resources/assets/plugins/dataTables/js/jquery.dataTables.js')}}"></script>
<script src="{{url('resources/assets/plugins/dataTables/js/dataTables.bootstrap.js')}}"></script>
<script>
@stop