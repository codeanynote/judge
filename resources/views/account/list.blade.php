
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
            <li>Account</li>
            <li class="active active-title">List Of Account</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Accounts Table</h3>
                <div class="actions pull-right">
                    <a class="btn-down" href="{{route('account.export')}}"><i class="fa fa-download" style="font-size:20px"></i></a>
                    <a class="btn-print" href="{{route('account.print')}}" target="new"><i class="fa fa-print" style="font-size:20px"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="accountTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Account Number</th>
                                <th>User Name</th>
                                <th>E-mail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($accounts as $key=>$account)
                            <tr>
                                <td nowrap align="right">{{$account->userid}}</td>
                                <td nowrap>{{$account->username}}</td>
                                <td nowrap>{{$account->email}}</td>
                                <td nowrap>
                                    <a class="btn btn-info btn-sm" href="{{route('account.detail', $account->userid)}}">View</a>
                                    <a class="btn btn-primary btn-sm" href="{{route('account.edit', $account->userid)}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal_{{$account->userid}}">Delete</a>
                                    <!-- Confirm Modal -->
                                    <div class="modal fade" id="confirmModal_{{$account->userid}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a type="button" class="btn btn-primary" href="{{route('account.delete', $account->userid)}}">Confirm</a>
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
    $('#accountTable').dataTable();
});
</script>
@stop