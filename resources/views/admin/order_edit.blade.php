@extends('admin.layout.header')
@section('headerTitle')
Thông tin Đơn hàng
@endsection

@section('css')

@endsection
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Đơn: {{$Order->id}}
    </h1>
  </section>

  <section class="content" data-bind="with: orderViewModel">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />

    <div class="box box-info">
      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Khách hàng</label>
            <div class="col-sm-4">
              <input type="text" readonly="readonly" class="form-control" data-bind="value: customer_name">
            </div>
            <label class="col-sm-2 control-label">SĐT</label>
            <div class="col-sm-4">
              <input type="text" readonly="readonly" class="form-control" value="{{$Order->customer_phone}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
              <input type="text" readonly="readonly" class="form-control" value="{{$Order->customer_email}}">
            </div>

            <label class="col-sm-2 control-label">Tour</label>
            <div class="col-sm-4">
              <input type="text" readonly="readonly" class="form-control" data-bind="value: tour()?tour().title:''">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Số hành khách</label>
            <div class="col-sm-4">
              <input type="text" readonly="readonly" class="form-control" data-bind="value: no_of_passengers">
            </div>

            <label class="col-sm-2 control-label">Loại xe</label>
            <div class="col-sm-4">
              <input type="text" readonly="readonly" class="form-control" data-bind="value: car_type">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Nơi đón</label>
            <div class="col-sm-10">
              <input type="text" readonly="readonly" class="form-control" value="{{$Order->pick_up_location}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Thời gian đón</label>
            <div class="col-sm-10">
              <input type="text" readonly="readonly" class="form-control" value="{{$Order->pick_up_time}}" placeholder="Từ khóa">
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Xử lý đơn hàng</h3>
      </div>
      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
              <textarea class="form-control" data-bind='value: detail' rows="5"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Tài xế</label>
            <div class="col-sm-4">
              <select class="form-control" style="width: 100%; padding: 0px 5px;" data-bind="options: $root.Drivers,  optionsText: 'name', optionsValue: 'id', value: driver_id, optionsCaption: 'Chọn Tài Xế'"></select>
              <span data-bind="text: $root.getDriverInfo(driver_id())"></span>
            </div>
            <label class="col-sm-2 control-label">Loại xe</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" data-bind="value: car_model" placeholder="Nhập loại xe">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Giá</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" data-bind="value: price">
              <span data-bind="text: $root.formatMoney(price())"></span> </div>
            <label class="col-sm-2 control-label">Trạng thái</label>
            <div class="col-sm-4">
              <select class="form-control" style="width: 100%; padding: 0px 5px;" data-bind="options: $root.OrderStatues,  optionsText: 'name', optionsValue: 'id', value: order_status_id"></select>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button class="btn btn-info pull-right" data-bind="click: $root.saveOrder">Save</button>
          <button class="btn btn-default pull-right" data-bind="click: $root.sendEmailRemindOrder">Gửi Email</button>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection

@section('script')
<script src="{{asset('admin_asset/order_edit.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#treeOrder').addClass("active");
    var data = {};
    var options = {};

    data.Order = <?php echo json_encode($Order); ?>;

    data.OrderStatues = <?php echo json_encode($OrderStatues); ?>;
    data.Drivers = <?php echo json_encode($Drivers); ?>;
    options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
    options.PublicPath = <?php echo json_encode(url('')); ?>;
    options.SaveOrder = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/order/edit')); ?>;
    options.SendEmailRemindOrder = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/order/sendEmailRemindOrder')); ?>;
    data.API_URLs = options;

    ko.applyBindings(new FormViewModel(data));
  })
</script>
@endsection