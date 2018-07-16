<div class="user-nav">
    <ul>
        <li class="dropdown settings">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {{Auth::user()->username}} <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li>
                    <a href="{{route('account.edit',Auth::user()->userid)}}"><i class="fa fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="{{route('account.password.change')}}"><i class="fa fa-chain"></i> passowrd</a>
                </li>
                <li>
                    <a href="{{route('auth.logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</div>