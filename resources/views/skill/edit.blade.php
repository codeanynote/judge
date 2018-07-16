
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Skill Level</li>
            <li class="active active-title">Edit Skill Level</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Form Skill</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal form-border" action="{{route('skill.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="level_id" value="{{$skill->level_id}}"/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Skill</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="level_name" name="level_name" value="{{$skill->level_name}}">
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
    $(function () {

    });
</script>
@stop