@extends('auth.layouts.master')

@section('content')
    <!-- Forgot Password -->
    <form class="box animated tile active form-validation-email" id="box-reset" method="post" action="{{route('password.store')}}" autocomplete="off">
        {{ csrf_field() }}
        <div class="errorHandler alert alert-danger no-display">
            <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
        </div>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="form-group has-error">
                    <div class="col-md-12">
                        <div class="alert alert-danger"><button data-dismiss="alert" class="close">&times;</button>{{ $error }}</div>
                    </div>
                </div>
            @endforeach
        @endif

        <h2 class="m-t-0 m-b-15">Forgot Password?</h2>
        <p>Enter your Jabber below to reset your password.</p>
        <input type="text" class="login-control m-b-10 validate[required]" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
        <input type="text" id="jabber" name="jabber" class="login-control m-b-20 validate[required, custom[email]]" placeholder="Jabber ID" value="{{ old('jabber') }}">
        <div class="captcha-div">
            <a href="javascript:void(0)" onclick="refreshCaptcha()" class="refereshrecapcha">
                {!! captcha_img('flat') !!}
            </a>
            <span class="input-icon" style="width:200px; float: right;">
                <input type="text" class="form-control captcha validate[required]" name="captcha">
                <i class="fa fa-key"></i> </span>
            </span>
        </div>
        <button type="submit" class="btn btn-sm m-r-5">Reset Password</button>

        <small><a href="{{route('auth.showlogin')}}">Already have an Account?</a></small>
    </form>
@endsection
