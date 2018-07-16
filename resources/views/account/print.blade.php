
@extends('print_master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">
@stop
@section('content')

<table id="accountTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Account Number</th>
            <th>User Name</th>
            <th>E-mail</th>
        </tr>
    </thead>

    <tbody>
        @foreach($accounts as $key=>$account)
        <tr>
            <td nowrap align="right">{{$account->userid}}</td>
            <td nowrap>{{$account->username}}</td>
            <td nowrap>{{$account->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@stop

@section('script')
<!--Page Leve JS -->
<script src="{{url('resources/assets/plugins/dataTables/js/jquery.dataTables.js')}}"></script>
<script src="{{url('resources/assets/plugins/dataTables/js/dataTables.bootstrap.js')}}"></script>
@stop