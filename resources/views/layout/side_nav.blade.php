<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">

<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{asset('/assets/admin/images/user.png')}}" alt="User Image">
      <div>
        <p class="app-sidebar__user-name">{{ Auth::user()->name??'Guest User' }}</p>
        <p class="app-sidebar__user-designation"></p>
      </div>
    </div>
    <ul class="app-menu">
      <!-- <li><a class="app-menu__item" href="{{url('/home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li> -->


      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Post</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          
          <li><a class="treeview-item" href="{{ route('posts.index') }}"><i class="icon fa fa-circle-o"></i>All Post  </a></li>
          @auth
          <li><a class="treeview-item" href="{{ route('posts.create') }}"><i class="icon fa fa-circle-o"></i>Add Post</a></li>
          @endauth
          
        </ul>
      </li>

     
     
     
  </aside>
