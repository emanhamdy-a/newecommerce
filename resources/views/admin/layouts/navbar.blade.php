<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    @include('admin.layouts.menu')
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('design/Adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <a href="#"></a>
          <p>{{ admin()->user()->name }}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="header"></li> -->

        <li class="treeview {{ active_menu('')[0] }}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{ trans('admin.dashboard') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
            <li class=""><a href="{{ aurl('dashboard') }}">
              <i class="fa fa-cog"></i> <span>{{ trans('admin.dashboard') }}</span>
              <span class="pull-right-container">
              </span>
              </a>
            </li>
            <li class=""><a href="{{ aurl('settings') }}">
              <i class="fa fa-cog"></i> <span>{{ trans('admin.settings') }}</span>
              <span class="pull-right-container">
              </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('admins')[0] }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.admins') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('admins')[1] }}">
            <li class=""><a href="{{ aurl('admins') }}"><i class="fa fa-users"></i> {{ trans('admin.admins') }}</a></li>
            <li class=""><a href="{{ aurl('admins/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('users')[0] }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.users') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('users')[1] }}">
            <li class=""><a href="{{ aurl('users') }}"><i class="fa fa-users"></i> {{ trans('admin.users') }}</a></li>
            <li class=""><a href="{{ aurl('users') }}?level=user"><i class="fa fa-users"></i> {{ trans('admin.user') }}</a></li>
            <li class=""><a href="{{ aurl('users') }}?level=vendor"><i class="fa fa-users"></i> {{ trans('admin.vendor') }}</a></li>
            <li class=""><a href="{{ aurl('users') }}?level=company"><i class="fa fa-users"></i> {{ trans('admin.company') }}</a></li>
            <li class=""><a href="{{ aurl('users/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('countries')[0] }}">
          <a href="#">
            <i class="fa fa-flag"></i> <span>{{ trans('admin.countries') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('countries')[1] }}">
            <li class=""><a href="{{ aurl('countries') }}"><i class="fa fa-flag"></i> {{ trans('admin.countries') }}</a></li>
            <li class=""><a href="{{ aurl('countries/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('currencies')[0] }}">
          <a href="#">
            <i class="fa fa-flag"></i> <span>{{ trans('admin.currencies') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('currencies')[1] }}">
            <li class=""><a href="{{ aurl('currencies') }}"><i class="fa fa-flag"></i> {{ trans('admin.currencies') }}</a></li>
            <li class=""><a href="{{ aurl('currencies/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('departments')[0] }}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{ trans('admin.departments') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('departments')[1] }}">
            <li class=""><a href="{{ aurl('departments') }}"><i class="fa fa-list"></i> {{ trans('admin.departments') }}</a></li>
            <li class=""><a href="{{ aurl('departments/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('trademarks')[0] }}">
          <a href="#">
            <i class="fa fa-cube"></i> <span>{{ trans('admin.trademarks') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('trademarks')[1] }}">
            <li class=""><a href="{{ aurl('trademarks') }}"><i class="fa fa-cube"></i> {{ trans('admin.trademarks') }}</a></li>
            <li class=""><a href="{{ aurl('trademarks/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('manufactures')[0] }}">
          <a href="#">
            <i class="fa fa-user"></i> <span>{{ trans('admin.manufactures') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('manufactures')[1] }}">
            <li class=""><a href="{{ aurl('manufactures') }}"><i class="fa fa-user"></i> {{ trans('admin.manufactures') }}</a></li>
            <li class=""><a href="{{ aurl('manufactures/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('merchants')[0] }}">
          <a href="#">
            <i class="fa fa-building"></i> <span>{{ trans('admin.merchants') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('merchants')[1] }}">
            <li class=""><a href="{{ aurl('merchants') }}"><i class="fa fa-building"></i> {{ trans('admin.merchants') }}</a></li>
            <li class=""><a href="{{ aurl('merchants/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
        <!--  -->
        <li class="treeview {{ active_menu('colors')[0] }}">
          <a href="#">
            <i class="fa fa-paint-brush"></i> <span>{{ trans('admin.colors') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('colors')[1] }}">
            <li class=""><a href="{{ aurl('colors') }}"><i class="fa fa-paint-brush"></i> {{ trans('admin.colors') }}</a></li>
            <li class=""><a href="{{ aurl('colors/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('sizes')[0] }}">
          <a href="#">
            <i class="fa fa-info-circle"></i> <span>{{ trans('admin.sizes') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('sizes')[1] }}">
            <li class=""><a href="{{ aurl('sizes') }}"><i class="fa fa-info-circle"></i> {{ trans('admin.weights') }}</a></li>
            <li class=""><a href="{{ aurl('sizes/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
        <!--  -->
        <li class="treeview {{ active_menu('weights')[0] }}">
          <a href="#">
            <i class="fa fa-info-circle"></i> <span>{{ trans('admin.weights') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('weights')[1] }}">
            <li class=""><a href="{{ aurl('weights') }}"><i class="fa fa-info-circle"></i> {{ trans('admin.weights') }}</a></li>
            <li class=""><a href="{{ aurl('weights/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('products')[0] }}">
          <a href="#">
            <i class="fa fa-tag"></i> <span>{{ trans('admin.products') }}</span>
            <span class="pull-right-container">

            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('products')[1] }}">
            <li class=""><a href="{{ aurl('products') }}"><i class="fa fa-tag"></i> {{ trans('admin.products') }}</a></li>
            <li class=""><a href="{{ aurl('products/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>
      </ul>
    </section>
<!-- /.sidebar -->
</aside>
