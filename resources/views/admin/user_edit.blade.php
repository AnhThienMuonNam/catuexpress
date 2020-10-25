@extends('admin.layout.header')
@section('headerTitle')
Tài khoản
@endsection
@section('content')

<div class="content-wrapper">
  <section class="content">
    <div class="row" data-bind="with: userModel">
      <div class="col-md-12">
        <div class="box box-solid">
          <!-- ko if: $root.NotifyErrors -->
          <div class="alert alert-danger">
            <span data-bind="text: $root.NotifyErrors"></span>
          </div>
          <!-- /ko -->
          <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
          <div class="box-body">
            <div class="form-group">
              <label>Họ tên</label>
              <input type="text" class="form-control" name="Name" data-bind="value: name">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" readonly="readonly" data-bind="value: email" name="Email" placeholder="Nhập email">
            </div>
            <div class="form-group">
              <label>Role</label>
              <div class="checkbox">
                <label>
                  <input type="checkbox" data-bind="checked: is_admin"> Admin
                </label>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right" data-bind="click: $root.editUser">Save</button>
          </div>
        </div>
        @if($user->id == Auth::User()->id)
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Đổi mật khẩu</h3>
          </div>
          <form role="form" action="{{url(config('constants.ADMIN_PREFIX').'/account/changePasswordPost/'.$user->id)}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="box-body">
              <div class="form-group">
                <label>Mật khẩu cũ</label>
                <input type="password" class="form-control" name="OldPassword" placeholder="Mật khẩu">
              </div>
              <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" class="form-control" name="NewPassword" placeholder="Mật khẩu">
              </div>
              <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" class="form-control" name="NewPasswordx2" placeholder="Xác nhận mật khẩu">
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>
        </div>
        @endif
      </div>
    </div>
  </section>
</div>

@endsection
@section('script')
<script src="{{asset('admin_asset/user_edit.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#treeUser').addClass("active");
    var data = {};
    var options = {};
    data.User = <?php echo json_encode($user); ?>;
    options.EditUser = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/account/editPost')); ?>;

    data.API_URLs = options;

    ko.applyBindings(new FormViewModel(data));
  })
</script>
@endsection