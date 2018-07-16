
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Accounts</li>
            <li class="active active-title">Add New Account</li>
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
                <form class="form-horizontal form-border" action="{{route('account.create')}}" method="post" autocomplete="off">
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Account Name*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="username"  value="{{ old('username') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email*</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" required id="email" name="email"  value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password*</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" required id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Retype Password*</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" required id="password_confirmation" name="password_confirmation">
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
@stop