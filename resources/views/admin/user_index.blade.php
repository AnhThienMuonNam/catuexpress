@extends('admin.layout.header')
@section('headerTitle')
Tài khoản
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Họ tên</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody data-bind="foreach: Users">
                <tr>
                  <td data-bind="text: id"></td>
                  <td> <a data-bind="attr: { href: 'account/' + id }, text: name"></a></td>
                  <td data-bind="text: email"></td>
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
<script src="{{asset('admin_asset/user_index.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#treeUser').addClass("active");
    document.getElementById("tabUserList").classList.add("active");
    var data = {};
    var options = {};
    data.Users = <?php echo json_encode($Users); ?>;

    options.SearchUser = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/account/search')); ?>;
    data.API_URLs = options;
    ko.applyBindings(new FormViewModel(data));
  });
</script>
@endsection