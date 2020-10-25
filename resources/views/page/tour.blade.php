@extends('page.layout.master')

@section('css')

@endsection

@section('content')
<div id="page-home-ko">
    <div class="banner" id="home">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light top-header">
                <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-lg-0" href="{{url('')}}">Trang chủ</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('tour')}}">Tours</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>
    <section class="why">
        <div class="container-fluid p-md-5 p-3">
            <div class="row why-grids">
                <!-- ko foreach: Tours -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="py-5 px-2 mb-4 grid1 text-center" data-bind="click: viewDetailTour, style: { background: 'url('+ ImagePath() + '/' +$data.image +')', backgroundSize:'cover', cursor: 'pointer' }">
                        <h4 class="mx-auto"><span data-bind="text: $index() + 1"></span></h4>
                        <p class="mt-5"><span data-bind="text: $data.title"></span></p>
                    </div>
                </div>
                <!-- /ko -->

            </div>

        </div>
    </section>

    <!-- login and register modal -->
    <div class="modal fade" id="detailTourModal" tabindex="-1" role="dialog" aria-labelledby="detailTourModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" data-bind="with: detailTourViewModel">
                <div class="modal-header">
                    <h5 class="modal-title"><span data-bind="text: title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Giới thiệu</label>
                            <p class="mb-3" data-bind="text: description"></p>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Giá (ước tính cho 1 hành khách)</label>
                            <input type="text" readonly class="form-control" data-bind="value: formatMoney(price())">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control custom-button-booking custom-button-close" data-dismiss="modal" value="Đóng">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //login and register modal -->
</div>

@endsection

@section('script')
<script src="{{asset('page_asset/page-index.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var data = {};
        var options = {};
        data.Tours = <?php echo json_encode($MasterTours); ?>;

        options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
        options.PublicPath = <?php echo json_encode(url('')); ?>;

        data.API_URLs = options;
        ko.applyBindings(IndexViewModel(data), document.getElementById("page-home-ko"));
    });
</script>
@endsection