<header class="app-header"><a class="app-header__logo" href="#">Blog App</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search">

      </li>

      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="{{ Auth::check() ? 'fa fa-user' : 'fa fa-sign-in'  }}  fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
@guest
          <li><a class="dropdown-item" href="{{route('login')}}"><i class="fa fa-sign-in fa-lg"></i> Login</a></li>
          @endguest
          @auth
          <li><a class="dropdown-item" href="{{route('ShowChangePassword')}}"><i class="fa fa-user fa-lg"></i> Change Password</a></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out fa-lg"></i>Logout </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  </li>
                                  @endauth
        </ul>
      </li>
    </ul>
  </header>
