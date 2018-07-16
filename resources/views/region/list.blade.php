
@extends('master')
@section('style')    
<!-- DataTables-->
<link rel="stylesheet" href="{{url('resources/assets/plugins/dataTables/css/dataTables.css')}}">

<style>
    .modal-title{
        display: inline;
    }
    .col-form-label{
        text-align: right;
    }
</style>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Setting</li>
            <li class="active active-title">List Of Region</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Region Table</h3>
                
            </div>
            <div class="panel-body">
                <div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#addRegionModal" role="button">
                        <span class="fa fa-plus">Add Region</span>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="addRegionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a region</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="regionForm" class="form-horizontal form-border" action="{{route('region.save')}}" method="post" autocomplete="off">
                                    {{csrf_field()}}
                                    <input type="hidden" name="region_id" id="region_id">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label col-sm-3">Region:</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="region_name" class="form-control" id="region_name">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary add-region">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="regionTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Region Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php 
                                $i = 1
                            @endphp
                            @foreach($region_list as $key=>$region)
                            
                            <tr>
                                <td nowrap align="right">{{$i}}</td>
                                <td nowrap>{{$region->region_name}}</td>
                                <td nowrap>
                                    <a class="btn btn-info btn-sm" href="{{route('region.detail', $region->region_id)}}">View</a>
                                    <a class="btn btn-primary btn-sm" href="{{route('region.edit', $region->region_id)}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal_{{$region->region_id}}">Delete</a>
                                    <!-- Confirm Modal -->
                                    <div class="modal fade" id="confirmModal_{{$region->region_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a type="button" class="btn btn-primary" href="{{route('region.delete', $region->region_id)}}">Confirm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Confirm Modal -->
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
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
    $('#regionTable').dataTable();

    $('.add-region').click(function(){
        $('#regionForm').submit();
    })
});
</script>
@stop