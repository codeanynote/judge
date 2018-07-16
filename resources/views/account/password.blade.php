
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Accounts</li>
            <li class="active active-title">{{$page_title}}</li>
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
                <form class="form-horizontal form-border" action="{{route('account.password.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}

                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <div class="form-group has-error">
                        <div class="col-md-12">
                            <div class="alert alert-danger"><button data-dismiss="alert" class="close">&times;</button>{{ $error }}</div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if (session()->has('message'))
                    <div class="form-group has-success">
                        <div class="col-md-12">
                            <div class="alert alert-success"><button data-dismiss="alert" class="close">&times;</button>{!! session()->get('message') !!}</div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label">New Password*</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" required id="password" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Retype Password*</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" required id="password" name="password_confirmation" value="">
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