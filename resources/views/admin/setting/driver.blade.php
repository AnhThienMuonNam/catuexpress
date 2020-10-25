@extends('admin.layout.header')

@section('headerTitle')
Tài Xế
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tài Xế
    </h1>
  </section>
  <section class="content">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <a href="#" data-bind="click: createView" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Thêm Tài Xế</a>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>SĐT</th>
                  <th></th>
                </tr>
              </thead>
              <tbody data-bind="foreach: Drivers">
                <tr>
                  <td data-bind="text: id"></td>
                  <td> <a href="#" data-bind="click: $root.editView, text: name"></a> </td>
                  <td data-bind="text: email"></td>
                  <td data-bind="text: phone"></td>
                  <td>
                    <a href="#" data-bind="click: $root.removeDriver" title="Xóa" class="text-danger"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal modal-default fade" id="modal-driver">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" data-bind="with: itemModel">
        <div class="form-group">
          <label>Tên</label>
          <input type="text" class="form-control" placeholder="Tên" data-bind="value: name">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" placeholder="Email" data-bind="value: email">
        </div>
        <div class="form-group">
          <label>SĐT</label>
          <input type="number" class="form-control" placeholder="SĐT" data-bind="value: phone">
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" data-bind="checked: is_active"> Active
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" data-bind="checked: home_page_show"> Hiển thị trang chủ
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>Hình ảnh</label>
          <input type="file" id="uploadFile" class="form-control-file" name="uploadFile" data-bind="event: { change: uploadImages }">
          <input type="hidden" name="Image" data-bind="value: image">
        </div>

        <div class="form-group">
          <!-- ko if: image() -->
          <div class='thumbnail' style="text-align: center;">
            <img data-bind="attr: { src: $root.ImagePath() + '/' + image() }" style='width:auto; max-height: 200px;'>
          </div>
          <!-- /ko -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-info" data-bind="click: saveEdit">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('admin_asset/admin_setting/admin-driver.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#treeSetting').addClass("active");
    document.getElementById("tabSettingDriver").classList.add("active");
    var data = {};
    var options = {};

    data.Drivers = <?php echo json_encode($Drivers); ?>;

    options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
    options.UploadImage = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/uploadImage')); ?>;
    options.DeleteDriver = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/driver/delete')); ?>;
    options.EditDriver = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/driver/editPost')); ?>;
    options.CreateDriver = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/driver/createPost')); ?>;
    data.API_URLs = options;
    ko.applyBindings(new FormViewModel(data));
  });
</script>
@endsection