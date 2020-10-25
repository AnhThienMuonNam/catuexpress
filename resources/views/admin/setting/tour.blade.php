@extends('admin.layout.header')

@section('headerTitle')
Tours
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tours
    </h1>
  </section>
  <section class="content">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <a href="#" data-bind="click: createView" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Thêm Tour</a>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Giá</th>
                  <th></th>
                </tr>
              </thead>
              <tbody data-bind="foreach: Tours">
                <tr>
                  <td data-bind="text: id"></td>
                  <td> <a href="#" data-bind="click: $root.editView, text: title"></a> </td>
                  <td data-bind="text: $root.formatMoney(price)"></td>
                  <td>
                    <a href="#" data-bind="click: $root.removeTour" title="Xóa" class="text-danger"><i class="fa fa-trash-o"></i></a>
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
<div class="modal modal-default fade" id="modal-tour">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" data-bind="with: itemModel">
        <div class="form-group">
          <label>Tên</label>
          <input type="text" class="form-control" placeholder="Tên" data-bind="value: title">
        </div>
        <div class="form-group">
          <label>Giới thiệu</label>
          <input type="text" class="form-control" placeholder="Giới thiệu" data-bind="value: description">
        </div>
        <div class="form-group">
          <label>Giá</label>
          <input type="text" class="form-control" placeholder="Giá" data-bind="value: price">
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
<script src="{{asset('admin_asset/admin_setting/admin-tour.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#treeSetting').addClass("active");
    document.getElementById("tabSettingTour").classList.add("active");
    var data = {};
    var options = {};

    data.Tours = <?php echo json_encode($Tours); ?>;

    options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
    options.UploadImage = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/uploadImage')); ?>;
    options.DeleteTour = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/tour/delete')); ?>;
    options.EditTour = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/tour/editPost')); ?>;
    options.CreateTour = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/tour/createPost')); ?>;
    data.API_URLs = options;
    ko.applyBindings(new FormViewModel(data));
  });
</script>
@endsection