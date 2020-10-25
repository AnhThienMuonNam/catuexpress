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
              <input type="text" class="form-control" name="Name" data-bind="value: name" placeholder="Nhập họ tên">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" data-bind="value: email" name="Email" placeholder="Nhập email">
            </div>

            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="text" class="form-control" name="password" data-bind="value: password" placeholder="Mật khẩu">
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
            <button type="button" class="btn btn-primary pull-right" data-bind="click: $root.createUser">Add</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
@section('script')
<script src="{{asset('admin_asset/user_create.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#treeUser').addClass("active");

    var data = {};
    var options = {};

    options.CreateUser = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/account/createPost')); ?>;
    data.API_URLs = options;

    ko.applyBindings(new FormViewModel(data));
  })
</script>
@endsection