@extends('admin.layout.header')
@section('headerTitle')
Đơn hàng
@endsection

@section('css')

@endsection
@section('content')

<div class="content-wrapper">
    <section class="content" data-bind="with: orderModel">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Đơn hàng&nbsp;</h3><span style="cursor: pointer; font-style: italic;" data-bind="click: addOrderDetail">(Thêm)</span>
            </div>
            <ul class="list-group">
                <!-- ko foreach: banners -->
                <li class="list-group-item">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class=" col-sm-1 control-label">Tiêu đề</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" data-bind="value: title" placeholder="Giá">
                                </div>
                                <label class="col-sm-1 control-label">Ảnh</label>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control-file" data-bind="event: { change: uploadImages }">
                                    <input type="hidden" name="Image" data-bind="value: image">
                                    <!-- ko if: image() -->
                                    <div class='thumbnail' style="text-align: center;">
                                        <img data-bind="attr: { src: $root.ImagePath() + '/' + image() }" style='width:auto; max-height: 200px;'>
                                    </div>
                                    <!-- /ko -->
                                </div>
                                <div class="col-sm-2">
                                    <span style="cursor: pointer;" title="Xoá" class="text-danger pull-right" data-bind="click: $parent.removeOrderDetail"> <i class="fa fa-trash-o "></i></span>
                                </div>
                            </div>
                        </div>

                    </form>
                </li>
                <!-- /ko -->
            </ul>
        </div>
        <div class="box box-info">
            <div class="box-footer">
                <button class="btn btn-info pull-right" data-bind="click: $root.saveOrder">Save</button>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script src="{{asset('admin_asset/order_create.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#treeOrderAdd').addClass("active");
        var data = {};
        var options = {};
        options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
        options.UploadImage = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/uploadImage')); ?>;
        options.CreateOrder = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/order/createPost')); ?>;
        data.API_URLs = options;

        ko.applyBindings(new FormViewModel(data));
    })
</script>
@endsection