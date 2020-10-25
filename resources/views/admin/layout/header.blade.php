<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> @yield('headerTitle') - CatuExpress</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="https://www.w3schools.com/images/colorpicker.gif">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('css/_adminbootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/nprogress.css')}}">
  <link rel="stylesheet" href="{{asset('css/alertify.min.css')}}" type="text/css" media="screen" property="" />
  @yield('css')

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <header class="main-header">
      <a href="#" class="logo">
        <span class="logo-mini">CE</span>
        <span class="logo-lg">CatuExpress</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            @if(Auth::check())
            <li class="user user-menu">
              <a href="{{url(config('constants.ADMIN_PREFIX').'/account/'.Auth::user()->id)}}">
                <strong>
                  <span class="hidden-xs">{{Auth::user()->name}}</span></strong>
              </a>
            </li>
            <li class="user user-menu">
              <a href="{{url(config('constants.ADMIN_PREFIX').'/logout')}}">
                <span class="hidden-xs">Đăng xuất</span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu</li>
          <li id="treeOrder">
            <a href="{{url(config('constants.ADMIN_PREFIX').'/order')}}">
              <i class="fa fa-cart-arrow-down"></i> <span>Đơn hàng</span>
            </a>
          </li>
          <li id="treeUser" class="treeview">
            <a href="#">
              <i class="fa fa-id-card"></i> <span>Account</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul id="treeUser" class="treeview-menu">
              <li id="tabUserList"><a href="{{url(config('constants.ADMIN_PREFIX').'/account')}}"><i class="fa fa-list"></i> Danh sách Tài khoản</a></li>
              <li id="tabUserCreate"><a href="{{url(config('constants.ADMIN_PREFIX').'/account/create')}}"><i class="fa fa-plus"></i> Thêm Tài khoản</a></li>
            </ul>
          </li>
          <li id="treeSetting" class="treeview">
            <a href="#">
              <i class="fa fa-cog"></i> <span>Khác</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="tabSettingDriver"><a href="{{url(config('constants.ADMIN_PREFIX').'/driver')}}"><i class="fa fa-circle"></i>Tài Xế</a></li>
              <li id="tabSettingTour"><a href="{{url(config('constants.ADMIN_PREFIX').'/tour')}}"><i class="fa fa-circle"></i>Tour</a></li>
              <li id="tabSettingCar"><a href="{{url(config('constants.ADMIN_PREFIX').'/car')}}"><i class="fa fa-circle"></i>Các loại xe</a></li>
            </ul>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- End Left side column. contains the logo and sidebar -->
    <!-- Left side column. contains the logo and sidebar -->
    @yield('content')

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <!-- knouckout js -->
  <script src="{{asset('js/knockout-3.4.2.js')}}"></script>
  <script src="{{asset('js/knockout.validation.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('js/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('js/moment.min.js')}}"></script>
  <!-- datepicker -->
  <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
  <!-- Slimscroll -->
  <script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('js/fastclick.js')}}"></script>

  <script src="{{asset('js/nprogress.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/adminlte.min.js')}}"></script>
  <script defer src="{{asset('js/alertify.min.js')}}"></script>
  @yield('script')

</body>

</html>