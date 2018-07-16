@extends('auth.layouts.master')

@section('content')
<!-- Register -->
<div class="panel-body">
    <p >Already a member? <a href="{{route('auth.showlogin')}}"><strong>Sign In</strong></a></p>
    <form id="box-register" method="post" action="{{route('user.store')}}" autocomplete="off" role="form">
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
            <label for="username">Name</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name" value="{{ old('username') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="regemail" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Retype Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation" placeholder="Retype your password">
        </div>

        <button class="btn btn-primary btn-block">Sign Up</button>
    </form>

</div>
</div>
@endsection
