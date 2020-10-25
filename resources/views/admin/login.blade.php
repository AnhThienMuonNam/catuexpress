<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng nhập trang quản trị SagittB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <!-- iCheck -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">CatuExpress</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Đăng nhập hệ thống</p>
      <!-- ko if: ErrorNotify -->
      <div class="alert alert-danger" data-bind="text: ErrorNotify">
      </div>
      <!-- /ko -->
      <!-- ko if: SuccessNotify -->
      <div class="alert alert-success" data-bind="text: SuccessNotify">
      </div>
      <!-- /ko -->

      <form role="form">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email" data-bind="value: Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Mật khẩu" data-bind="value: Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
       
        <div class="row">
          <div class="col-xs-12">
            <button type="button" class="btn btn-primary btn-block btn-flat" data-bind="click: Login">Đăng nhập</button>
          </div>
        </div>
      </form>
      <br>
      <!-- <a href="{{url('forgot-password')}}">Quên mật khẩu</a> -->
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  <!-- jQuery 3 -->
  <script src="{{asset('js/knockout-3.4.2.js')}}"></script>

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- iCheck -->
  <script src="{{asset('admin_asset/admin-login.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      var data = {};
      var options = {};
     
      options.Login = <?php echo json_encode(url(config('constants.ADMIN_PREFIX').'/login')); ?>;
      options.GetOTP = <?php echo json_encode(url(config('constants.ADMIN_PREFIX').'/getotp')); ?>;

      data.API_URLs = options;
      ko.applyBindings(new FormViewModel(data));
    });
  </script>

</body>

</html>