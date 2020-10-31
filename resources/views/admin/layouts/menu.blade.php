<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">

      <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-globe"></i>
        <span class="hidden-xs"> </span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{ aurl('lang/ar') }}"><i class="fa fa-flag"></i> عربى</a></li>
        <li><a href="{{ aurl('lang/en') }}"><i class="fa fa-flag"></i> English</a></li>
      </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->


    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ url('design/adminlte') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
        <span class="hidden-xs">{{ admin()->user()->name }}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="{{ url('design/adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

          <p>
            Alexander Pierce - Web Developer
            <small>Member since Nov. 2012</small>
          </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
          <div class="row">
            <div class="col-xs-4 text-center">
              <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Friends</a>
            </div>
          </div>
          <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
          </div>
          <div class="pull-right">
            <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>
