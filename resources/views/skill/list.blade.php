
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
            <li class="active active-title">List Of Skill</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Countries Table</h3>
                
            </div>
            <div class="panel-body">
                <div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#addSkillModal" role="button">
                        <span class="fa fa-plus">Add Skill</span>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="addSkillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a skill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="skillForm" class="form-horizontal form-border" action="{{route('skill.save')}}" method="post" autocomplete="off">
                                    {{csrf_field()}}
                                    <input type="hidden" name="level_id" id="level_id">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label col-sm-3">Skill:</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="level_name" class="form-control" id="level_name">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary add-skill">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="skillTable" class="table table-striped table-bordered table-responsive data-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Skill Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php 
                                $i = 1
                            @endphp
                            @foreach($skill_list as $key=>$skill)
                            
                            <tr>
                                <td nowrap align="right">{{$i}}</td>
                                <td nowrap>{{$skill->level_name}}</td>
                                <td nowrap>
                                    <a class="btn btn-info btn-sm" href="{{route('skill.detail', $skill->level_id)}}">View</a>
                                    <a class="btn btn-primary btn-sm" href="{{route('skill.edit', $skill->level_id)}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal_{{$skill->level_id}}">Delete</a>
                                    <!-- Confirm Modal -->
                                    <div class="modal fade" id="confirmModal_{{$skill->level_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a type="button" class="btn btn-primary" href="{{route('skill.delete', $skill->level_id)}}">Confirm</a>
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
    $('#skillTable').dataTable();

    $('.add-skill').click(function(){
        $('#skillForm').submit();
    })
});
</script>
@stop