<div id="sidebar" class="sidebar">
  <div data-scrollbar="true" data-height="100%">
    <ul class="nav text-center">
      <li class="nav-profile">
        <div class="info text-center">
          <img src="{{asset('assets/images/profile')}}/{{Auth::user()->photo}}" class="img-responsive img-rounded" style="max-height:70px; max-width: 70px; margin: auto;">
          <a href="{{route('profile')}}" style="text-decoration: none; font-size: 15px; color: #ddd;">{{Auth::user()->name}}</a>

          <small>{{Auth::user()->username}}</small>
        </div>
      </li>
    </ul>
    <ul class="nav" style="text-transform: uppercase;">
      <li class="@if(request()->path() == 'home') active @endif"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> 
       <li class="@if(request()->path() == 'home/profile') active @endif"><a href="{{route('profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a></li> 
      <li class="@if(request()->path() == 'home/referal') active @endif"><a href="{{route('referal')}}"><i class="fa fa-users" aria-hidden="true"></i> <span>Reference log</span></a></li>
      <li class="@if(request()->path() == 'home/my-coin') active @endif"><a href="{{route('myCoin')}}"><i class="fa fa-users" aria-hidden="true"></i> <span>{{$gnl->cur}} Purchase Log</span></a></li>
      <li class="@if(request()->path() == 'home/change-password') active @endif">
        <a href="{{route('changepass')}}"><i class="fa fa-lock" aria-hidden="true"></i> <span>Password</span></a>
      </li> 
      <li class="@if(request()->path() == 'home/g2fa') active @endif">
        <a href="{{route('go2fa')}}"><i class="fa fa-shield" aria-hidden="true"></i> <span>Security</span></a>
      </li>

      <li>
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>
        <span>SIGN OUT</span>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>

    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>

  </ul>

</div>

</div>
<div class="sidebar-bg"></div>
