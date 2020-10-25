@extends('admin.layout.header')

@section('headerTitle')
Đơn hàng
@endsection

@section('css')
<style type="text/css">
  .datepicker.datepicker-dropdown.dropdown-menu {
    z-index: 99999 !important;
  }
</style>
@endsection

@section('content')

<div class="content-wrapper">
  <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />

  <section class="content">
    <div class="box box-info" data-bind="with: searchViewModel">
      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">ID</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" data-bind="value: id" placeholder="ID">
            </div>

            <label class="col-sm-2 control-label">KH/Email/SĐT</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" data-bind="value: keyword" placeholder="Từ khóa">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Ngày đặt</label>
            <div class="col-sm-2">
              <input type="text" placeholder="Từ ngày" id="sFromDate" class="form-control mydatepicker" data-bind="event :{change: $root.changeSFromDate }">
            </div>
            <div class="col-sm-2">
              <input type="text" placeholder="Đến ngày" id="sToDate" class="form-control mydatepicker" data-bind="event :{change: $root.changeSToDate }">
            </div>
            <label class="col-sm-2 control-label">Trạng thái</label>
            <div class="col-sm-4">
              <select class="form-control" style="width: 100%; padding: 0px 5px;" data-bind="options: $root.OrderStatuses, optionsCaption:'-- Tất cả --', optionsText: 'name', optionsValue: 'id', value: orderStatusId"></select>
            </div>
          </div>

          <div class="form-group">

            <label class="col-sm-2 control-label">Tour</label>
            <div class="col-sm-4">
              <select class="form-control" style="width: 100%; padding: 0px 5px;" data-bind="options: $root.Tours, optionsCaption:'-- Tất cả --', optionsText: 'title', optionsValue: 'id', value: tourId"></select>
            </div>
            <label class="col-sm-2 control-label">Tài Xế</label>
            <div class="col-sm-4">
              <select class="form-control" style="width: 100%; padding: 0px 5px;" data-bind="options: $root.Drivers, optionsCaption:'-- Tất cả --', optionsText: 'name', optionsValue: 'id', value: driverId"></select>
            </div>
          </div>

          <!-- <div class="form-group"> -->

          <!--  <label class="col-sm-2 control-label">Tình trạng thanh toán</label>
                   <div class="col-sm-4">
                    <select class="form-control" data-bind="value: sIsPaid" style="width: 100%; padding: 0px 5px;">
                       <option value="">Chọn tình trạng thanh toán</option>
                      <option value="0">Chưa thanh toán</option>
                      <option value="1">Đã thanh toán</option>
                    </select>
                  </div> -->
          <!-- </div> -->
        </div>
        <div class="box-footer">
          <div class="pull-right">
            <button class="btn btn-info" data-bind="click: $root.search">Tìm Kiếm</button>
          </div>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Khách hàng</th>
                  <th>SĐT</th>
                  <th>Email</th>
                  <th>Tour</th>
                  <th>Loại xe</th>
                  <th>Số hành khách</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
              </thead>
              <tbody data-bind="foreach: Orders">
                <tr>
                  <td data-bind="text: id"></td>
                  <td data-bind="text: customer_name"></td>
                  <td data-bind="text: customer_phone"></td>
                  <td data-bind="text: customer_email"></td>
                  <td data-bind="text: tour.title"></td>
                  <td data-bind="text: car_type"></td>
                  <td data-bind="text: no_of_passengers"></td>

                  <td data-bind="text: order_status.name"></td>
                  <td>
                    <a data-bind="attr: { href: 'order/' + id }" title="Cập nhật" class="text-yellow"><i class="fa fa-pencil fa-2x"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo; Trang sau</a></li>
                <li><a href="#">Trang kế &raquo;</a></li>
              </ul>
            </div> -->
        </div>
      </div>
    </div>
</div>
</section>
</div>

@endsection

@section('script')
<script src="{{asset('admin_asset/order_index.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#treeOrder').addClass("active");
    $('.mydatepicker').datepicker({
      autoclose: true
    })

    var data = {};
    var options = {};

    options.SearchOrder = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/order/search')); ?>;

    data.OrderStatuses = <?php echo json_encode($OrderStatuses); ?>;
    data.Drivers = <?php echo json_encode($Drivers); ?>;
    data.Tours = <?php echo json_encode($Tours); ?>;

    data.API_URLs = options;
    ko.applyBindings(new FormViewModel(data));
  });
</script>
@endsection