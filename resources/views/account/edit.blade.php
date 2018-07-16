
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Accounts</li>
            <li class="active active-title">Edit Account</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Form Account</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal form-border" action="{{route('account.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="userid" value="{{$account->userid}}"/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >User Name*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="username" value="{{$account->username}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail*</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" readonly value="{{$account->email}}">
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
        $('#account_start_date').change(function () {
            var date = new Date($(this).val());
            var year = date.getFullYear();
            $('#year').val(year);
            $('#season').val(year + '-' + Number(year + 1));
        });
    });
</script>
@stop