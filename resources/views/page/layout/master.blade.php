<!DOCTYPE html>
<html lang="en">

<head>
  <title>Taxi Cab Transportation Category Flat Bootstrap Responsive Website Template | Home :: W3layouts</title>

  <!-- Meta tag Keywords -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="Taxi Cab Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!--// Meta tag Keywords -->

  <link rel="stylesheet" href="{{asset('catuexpress/css/owl.carousel.css')}}" type="text/css" media="all">
  <link rel="stylesheet" href="{{asset('catuexpress/css/owl.theme.css')}}" type="text/css" media="all">
  <link rel="stylesheet" href="{{asset('catuexpress/css/bootstrap.css')}}"> <!-- Bootstrap-Core-CSS -->
  <link rel="stylesheet" href="{{asset('catuexpress/css/style.css')}}" type="text/css" media="all" /> <!-- Style-CSS -->
  <link rel="stylesheet" href="{{asset('catuexpress/css/custom.css')}}" type="text/css" media="all" /> <!-- Custom-CSS -->
  <link rel="stylesheet" href="{{asset('catuexpress/css/jquery-ui.css')}}" />
  <link rel="stylesheet" href="{{asset('catuexpress/css/fontawesome-all.css')}}"> <!-- Font-Awesome-Icons-CSS -->
  <link rel="stylesheet" href="{{asset('css/alertify.css')}}" type="text/css" media="screen" property="" />
  <link rel="stylesheet" href="{{asset('css/nprogress.css')}}" type="text/css" media="screen" property="" />
  <!-- web-fonts -->
  <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
  <!-- //web-fonts -->

</head>

<body>
  <div class="top-bar_sub_w3layouts container-fluid" id="page-master">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />

    <div class="row">
      <div class="col-md-4 col-sm-6 log-icons mt-2">
        <p class="py-2"><i class="fas fa-phone"></i>Gọi: {{$About_Us->phone}}</p>
      </div>

      <div class="col-md-4 col-sm-6 logo">
        <a class="navbar-brand" href="{{url('')}}">
          <i class="fas fa-taxi"></i> Catuexpress</a>
      </div>
      <div class="col-md-4 top-forms mt-md-3 mt-2 mb-md-0 mb-3">
        <span>
          <a href="#" data-toggle="modal" data-target="#exampleModal1">
            <i class="fas fa-car"></i> Đặt Tour</a>
        </span>
      </div>
    </div>

    <!-- login and register modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" data-bind="with: masterBookViewModel">
          <div class="modal-body" style="padding: 0px;">
            <form action="#" method="post">
              <div class="container ">
                <div class="row">
                  <div class="col-lg-12 book-appointment p-sm-5 py-5 px-4">
                    <h2>Thông tin người đặt</h2>
                    <div class="book-agileinfo-form">
                      <form action="#" method="post">
                        <div class="row main-agile-sectns">
                          <div class="col-md-12 agileits-btm-spc form-text2">
                            <input type="text" name="Name" placeholder="Họ tên" data-bind="value: customer_name_master">
                          </div>
                        </div>
                        <div class="row main-agile-sectns">
                          <div class="col-md-12 agileits-btm-spc form-text2">
                            <input type="text" name="Phone no" placeholder="Số điện thoại" data-bind="value: customer_phone_master">
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col-md-12 agileits-btm-spc form-text2">
                            <input type="email" name="email" placeholder="Email" data-bind="value: customer_email_master">
                          </div>
                        </div>
                        <div class="clear"></div>
                        <h2 class="sub-head-w3ls">Chi tiết</h2>
                        <div class="main-agile-sectns">
                          <div class="agileits-btm-spc form-text2">
                            <select data-bind="options: Tours, optionsText: 'title', optionsValue: 'id', value: tour_id_master, optionsCaption: 'Chọn Tour'" class="frm-field cus_passengers required">
                            </select>
                            <small class="sub-head-w3ls" data-bind="text: '~' + formatMoney(price_master()) + '/khách'"></small>

                          </div>

                        </div>

                        <div class="row main-agile-sectns">
                          <div class="col-md-6 agileits-btm-spc form-text1">
                            <input type="text" name="Pick-up Location" placeholder="Số hành khách" data-bind="value: no_of_passengers_master">
                          </div>
                          <div class="col-md-6 agileits-btm-spc form-text2">
                            <select data-bind="options: Cars, optionsText: $data, optionsValue: $data, value: car_master, optionsCaption: 'Loại xe'" class="frm-field cus_passengers">
                            </select>
                          </div>
                        </div>

                        <div class="row main-agile-sectns">
                          <div class="col-md-12 agileits-btm-spc form-text2">
                            <input type="text" name="Pick-up Location" placeholder="Đón tại" data-bind="value: pick_up_location_master">
                          </div>
                        </div>
                        <div class="row main-agile-sectns">
                          <div class="col-md-5 agileits-btm-spc form-text1">
                            <input type="text" readonly placeholder="Thời gian đón" class="mydatepicker" data-bind="event :{change: onPickupTimeChange }">
                          </div>
                          <div class="col-md-3 agileits-btm-spc form-text1">
                            <select data-bind="options: Hours, optionsText: 'label', optionsValue: 'value', value: hour_master, optionsCaption: 'Giờ'" class="frm-field cus_passengers">
                            </select>
                          </div>
                          <div class="col-md-4 agileits-btm-spc form-text2">
                            <select data-bind="options: Minutes, optionsText: 'label', optionsValue: 'value', value: minute_master, optionsCaption: 'Phút'" class="frm-field cus_passengers">
                            </select>
                          </div>
                        </div>
                        <input type="hidden" id="pushTime" />
                        <input type="submit" value="Đặt chuyến" class="custom-button-booking" data-bind="click: createTour">
                        <input type="reset" value="Đóng" class="custom-button-booking custom-button-close" data-dismiss="modal">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- //login and register modal -->

  </div>

  @yield('content')


  <!--footer-->
  <footer class="py-sm-5 py-4 px-md-5 px-3">
    <div class="container-fluid pt-lg-5">
      <div class="row">
        <div class="col-lg-4 col-sm-6 mb-lg-0 mb-5 footer-grid-agileits-w3ls1 text-left">
          <h3 class="mb-sm-5 mb-4 mt-sm-0 mt-4">GIỚI THIỆU</h3>
          <p>{{$About_Us->intro}}</p>
        </div>
        <div class="col-lg-4 col-sm-6 mb-lg-0 mb-5 footer-grid-agileits-w3ls1 text-left">
          <h3 class="mb-sm-5 mb-4">LIÊN HỆ</h3>
          <ul class="w3ls-footer-bottom-list">
            <li> <span class="fas fa-map-marker"></span>{{$About_Us->address}}</li>
            <li> <span class="fas fa-envelope"></span> <a href="mailto:name@example.com">{{$About_Us->email}}</a> </li>
            <li> <span class="fas fa-phone"></span>{{$About_Us->phone}}</li>
            <li> <span class="fas fa-fax"></span>{{$About_Us->fax}}</li>
            <li> <span class="fas fa-globe"></span> <a href="#">{{$About_Us->website}}</a> </li>
          </ul>
        </div>

        <!-- subscribe -->
        <div class="col-lg-4 col-sm-6 subscribe-main footer-grid-agileits-w3ls text-left">
          <h3 class="mb-sm-5 mb-4">KẾT NỐI</h3>
          <!-- //subscribe -->
          <div class="footer-social">
            <div class="copyrighttop">
              <ul>
                <li class="mr-1">
                  <a class="facebook" href="{{$About_Us->facebook}}">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- //footer -->



  <!-- js-scripts -->

  <!-- js -->
  <script type="text/javascript" src="{{asset('catuexpress/js/jquery-2.1.4.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('catuexpress/js/bootstrap.js')}}"></script> <!-- Necessary-JavaScript-File-For-Bootstrap -->
  <script src="{{asset('catuexpress/js/owl.carousel.js')}}"></script>
  <script src="{{asset('catuexpress/js/responsiveslides.min.js')}}"></script>
  <script src="{{asset('catuexpress/js/jquery-ui.js')}}"></script>
  <script src="{{asset('js/knockout-3.4.2.js')}}"></script>
  <script src="{{asset('js/knockout.validation.min.js')}}"></script>
  <script src="{{asset('js/alertify.min.js')}}"></script>
  <script src="{{asset('js/nprogress.js')}}"></script>
  @section('script')
  <script src="{{asset('page_asset/page-master.js')}}"></script>
  <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 1,
          nav: false
        },
        900: {
          items: 2,
          nav: false
        },
        1000: {
          items: 3,
          nav: true,
          loop: false,
          margin: 20
        }
      }
    })
    $(document).ready(function() {
      $("#slider1").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "centered-btns"
      });

      $(".mydatepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        altFormat: "yy-mm-dd",
        altField: "#pushTime",
        minDate: new Date()
      });

      var data = {};
      var options = {};
      data.Tours = <?php echo json_encode($MasterTours); ?>;

      options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
      options.PublicPath = <?php echo json_encode(url('')); ?>;
      options.CreateOrder = <?php echo json_encode(url('createOrder')); ?>;

      data.API_URLs = options;
      ko.applyBindings(MasterViewModel(data), document.getElementById("page-master"));

    });
  </script>

  @yield('script')

</body>

</html>