@extends('admin.layout.header')

@section('headerTitle')
Topic
@endsection

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Topic
    </h1>
  </section>

  <section class="content">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            @if(\AppHelper::instance()->hasPermission('TOPIC_ADD'))
            <a href="{{url(config('constants.ADMIN_PREFIX').'/topic/create')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Thêm Topic</a>
            @endif
          </div>
          <div class="box-body table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Dòng tiêu đề</th>
                  <th>Url</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
              </thead>
              <tbody data-bind="foreach: Topics">
                <tr>
                  <td data-bind="text: id"></td>
                  <td><a data-bind="attr: { href: 'topic/edit/' + id }, text: line1 + ' | ' + line2 + ' | ' + line3"></a></td>
                  <td data-bind="text: url"></td>
                  <td data-bind="text: is_active ? 'Active' : 'Inactive'"></td>
                  <td>
                    @if(\AppHelper::instance()->hasPermission('TOPIC_DELETE'))
                    <a href="#" data-bind="click: $root.removeTopic" title="Xóa" class="text-danger"><i class="fa fa-trash-o fa-2x"></i></a>
                    @endif
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

@endsection

@section('script')
<script src="{{asset('admin_asset/admin_setting/topic/index.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#treeTopic').addClass("active");
    var data = {};
    var options = {};

    data.Topics = <?php echo json_encode($topics); ?>;
    options.DeleteTopic = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/topic/delete')); ?>;
    data.API_URLs = options;
    ko.applyBindings(new FormViewModel(data));
  });
</script>
@endsection