<ul class="nav nav-pills nav-stacked">
    <li class="@if($page_title=='Dashboard') active @endif">
        <a href="{{route('dashboard')}}" title="Dashboard">
            <i class="icon-speedometer"></i> Dashboard
        </a>
    </li>
    <li class="nav-dropdown @if($page_title=='Judge Add' || $page_title=='Judge List' || $page_title=='Judge Detail' || $page_title=='Judge Edit') active open @endif">
        <a href="#" title="Judges">
            <i class="fa fa-users"></i> Manage Line Judges
        </a>
        <ul class="nav-sub">
            <li class="@if($page_title=='Judge List' || $page_title=='Judge Detail' || $page_title=='Judge Edit' ) active @endif">
                <a href="{{route('judge.list')}}">View Line Judges</a>
            </li>
            <li class="@if($page_title=='Judge Add') active @endif">
                <a href="{{route('judge.create')}}">Add a Line Judge</a>
            </li>
        </ul>
    </li>
    <li class="nav-dropdown @if($page_title=='Event Add' || $page_title=='Event List' || $page_title=='Event Detail' || $page_title=='Event Edit' || $page_title=='LJ Information') active open @endif">
        <a href="#" title="Events">
            <i class="fa fa-table"></i> Manage Events
        </a>
        <ul class="nav-sub">
            <li class="@if($page_title=='Event List' || $page_title=='Event Detail' || $page_title=='Event Edit' ) active @endif">
                <a href="{{route('event.list')}}">View Events</a>
            </li>
            <li class="@if($page_title=='Event Add') active @endif">
                <a href="{{route('event.create')}}">Add a New Event</a>
            </li>
            <li class="@if($page_title=='LJ Information') active @endif">
                <a href="{{route('event.ljinfo')}}">Add LJs to Events</a>
            </li>
        </ul>
    </li>
    <li class="nav-dropdown @if($page_title=='LJ Duty' || $page_title=='Event Report') active open @endif">
        <a href="#" title="Manage Duty">
            <i class="fa fa-list-alt"></i> Reports
        </a>
        <ul class="nav-sub">
            <li class="@if($page_title=='LJ Duty') active @endif">
                <a href="{{route('duty.index')}}">Line Judge Duty</a>
            </li>
            <li class="@if($page_title=='Event Report') active @endif">
                <a href="{{route('duty.event')}}">Event Coverage</a>
            </li>
        </ul>
    </li>
    @if(Auth::user()->permission==1)
    <li class="nav-dropdown @if($page_title=='Account Add' || $page_title=='Account List' || $page_title=='Account Detail' || $page_title=='Account Edit') active open @endif">
        <a href="#" title="Events">
            <i class="fa fa-table"></i> Accounts
        </a>
        <ul class="nav-sub">
            <li class="@if($page_title=='Account List' || $page_title=='Account Detail' || $page_title=='Account Edit' ) active @endif">
                <a href="{{route('account.list')}}">List Of Accounts</a>
            </li>
            <li class="@if($page_title=='Event Add') active @endif">
                <a href="{{route('account.create')}}">Create New Account</a>
            </li>
        </ul>
    </li>
    <li class="nav-dropdown @if($page_title=='Countries' || $page_title=='Skill Levels' || $page_title=='Skill Level Detail' || $page_title=='Event Levels' || $page_title=='Event Level Detail') active open @endif">
        <a href="#" title="Events">
            <i class="fa fa-cog"></i> Field Values
        </a>
        <ul class="nav-sub">
            <li class="@if($page_title=='Countries') active @endif">
                <a href="{{route('country.list')}}">Countries</a>
            </li>
            <li class="@if($page_title=='Skill Levels' || $page_title=='Skill Level Detail') active @endif">
                <a href="{{route('skill.list')}}">Skill Levels</a>
            </li>
            <li class="@if($page_title=='Event Levels' || $page_title=='Event Level Detail') active @endif">
                <a href="{{route('event_level.list')}}">Event Levels</a>
            </li>
            <li class="@if($page_title=='Regions' || $page_title=='Region Detail') active @endif">
                <a href="{{route('region.list')}}">Regions</a>
            </li>
        </ul>
    </li>
    @endif
</ul>