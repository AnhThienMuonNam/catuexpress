@extends('admin.layout.header')
@section('headerTitle')
Phân quyền
@endsection
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <!-- ko if: NotifyErrors -->
                    <div class="alert alert-danger">
                        <span data-bind="text: $root.NotifyErrors"></span>
                    </div>
                    <!-- /ko -->
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <div class="box-body">
                        <!-- ko foreach: Permissions -->

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" data-bind="checked: $data.is_active"> <span data-bind="text: $data.name"></span>
                            </label>
                        </div>
                        <!-- /ko -->

                    </div>

                    <div class="box-footer">
                        @if(\AppHelper::instance()->hasPermission('OWNER'))
                        <button type="button" class="btn btn-primary pull-right" data-bind="click: savePermissions">Save</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@section('script')
<script src="{{asset('admin_asset/permissions.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#treeUser').addClass("active");
        document.getElementById("tabUserPermissions").classList.add("active");

        var data = {};
        var options = {};
        data.Permissions = <?php echo json_encode($Permissions); ?>;
        data.adminPermissions = <?php echo json_encode($adminPermissions); ?>;

        options.EditPermission = <?php echo json_encode(url(config('constants.ADMIN_PREFIX') . '/permissions/editPost')); ?>;
        data.API_URLs = options;

        ko.applyBindings(new FormViewModel(data));
    })
</script>
@endsection