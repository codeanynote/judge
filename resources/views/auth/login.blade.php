@extends('auth.layouts.master')

@section('content')
<div class="panel-body">
    <p> Login to access your account.</p>
    <form class="form-horizontal" id="box-login" method="post" action="{{ route('auth.login') }}" role="form">
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
            <div class="col-md-12">
                <input type="email" class="form-control  validate[required]" id="email" name="email" placeholder="Email"  value="{{ old('email') }}">
                <i class="fa fa-user"></i>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <input type="password" class="form-control  validate[required,minSize[6]]" id="password" name="password" placeholder="Password">
                <i class="fa fa-lock"></i>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                <hr />
                <a href="{{ route('user.create') }}" class="btn btn-default btn-block">Not a member? Sign Up</a>
            </div>
        </div>
    </form>
</div>
@stop