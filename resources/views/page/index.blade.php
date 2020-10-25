 @extends('page.layout.master')

 @section('css')

 @endsection

 @section('content')
 <div id="page-home-ko">
   <div class="banner" id="home">
     <!-- header -->
     <header>
       <nav class="navbar navbar-expand-lg navbar-light bg-light top-header">
         <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mx-auto">
             <li class="nav-item active">
               <a class="nav-link ml-lg-0" href="{{url('')}}">Trang chủ
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="{{url('tour')}}">Tours</a>
             </li>
           </ul>

         </div>
       </nav>
     </header>
     <!-- //header -->
     <!-- banner-text -->
     <div id="wrapper">
       <!-- Slideshow 1 -->
       <div class="rslides_container">
         <ul class="rslides" id="slider1">
           @foreach( $Banners as $banner )
           <li>
             <div class="banner-img" style="background:url({{asset('images/'.$banner->image)}})">
               <div class="bs-slider-overlay">
                 <div class="banner-info text-center">
                   <span class="fas fa-taxi"></span>
                   <h4>{{$banner->title}}</h4>
                   <a href="#" data-toggle="modal" data-target="#exampleModal1">ĐẶT TOUR</a>
                 </div>
               </div>
             </div>
           </li>
           @endforeach
         </ul>
       </div>
     </div>
   </div>

   <section class="about py-5">
     <div class="container py-lg-5 py-3">
       <h3 class="heading text-capitalize text-center">Giới Thiệu</h3>
       <h5 class="heading mb-5 text-center">catuexpress</h5>
       <div class="about-head text-center ">
         <div class="row about-grids-top mb-5">
           <div class="col-lg-3 col-sm-4 col-6 about-grid p-0">
             <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
             <h4>Giá Cạnh Tranh</h4>
           </div>
           <div class="col-lg-3 col-sm-4 col-6 about-grid p-0">
             <i class="fa fa-users" aria-hidden="true"></i>
             <h4>An toàn là trên hết</h4>
           </div>
           <div class="col-lg-3 col-sm-4 col-6 about-grid p-0">
             <i class="fa fa-car" aria-hidden="true"></i>
             <h4>Xe luôn sẵn sàng</h4>
           </div>
           <div class="col-lg-3 col-sm-4 col-6 mt-lg-0 mt-5 about-grid p-0">
             <i class="fa fa-cogs" aria-hidden="true"></i>
             <h4>Dịch vụ 24/7</h4>
           </div>
           <!-- <div class="col-lg-3 col-sm-4 col-6 mt-lg-0 mt-5 about-grid p-0">
             <i class="fa fa-smile" aria-hidden="true"></i>
             <h4>Lái xe thân thiện</h4>
           </div> -->
         </div>
         <div class="row about-grids-bottom text-left">
           <div class="col-md-3 about-bottom-grid">
             <p>Chúng tôi luôn đưa ra mức giá cạnh tranh nhất...</p>
           </div>
           <div class="col-md-3 about-bottom-grid">
             <p>Đội ngũ lái xe nhiều năm kinh nghiệm...</p>
           </div>
           <div class="col-md-3 about-bottom-grid">
             <p>Với nhiều loại xe đời mới, luôn sẵn sàng phục vụ...</p>
           </div>
           <div class="col-md-3 about-bottom-grid">
             <p>Bất cứ khi nào chúng tôi luôn sẵn sàng phục vụ quý khách...</p>
           </div>
         </div>
       </div>

     </div>
   </section>

   <section class="why">
     <div class="container-fluid p-md-5 p-3">
       <h3 class="heading text-capitalize text-center">TOUR</h3>
       <h5 class="heading mb-5 text-center"><a href="{{url('tour')}}">Xem tất cả...</a></h5>
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

   <section class="wthree-row py-5">
     <div class="container py-lg-5 py-3">
       <h3 class="heading text-capitalize text-center">Đội Ngũ Lái Xe</h3>
       <h5 class="heading mb-5 text-center">catuexpress</h5>
       <div class="row text-center">
         <!-- ko foreach: Drivers -->
         <div class="col-lg-3 col-sm-6 col-6 team-grids">
           <div class="team-effect">
             <img data-bind="attr: { src: ImagePath() + '/' + image }" alt="img" class="img-fluid">
           </div>
           <div class="footerv2-w3ls mt-3">
             <h4 data-bind="text: name"></h4>
             <p class="my-2" data-bind="text: email"></p>
             <p><i class="fas fa-phone" aria-hidden="true"></i> <span data-bind="text: phone"></span></p>
           </div>
         </div>
         <!-- /ko -->
       </div>
     </div>
   </section>

   <section class="services py-5">
     <div class="container py-lg-5">
       <h1 class="heading text-capitalize text-center">Các Loại Xe</h1>
       <h5 class="heading mb-5 text-center">catuexpress</h5>
       <div class="row service-grids">
         <!-- ko foreach: Cars -->

         <div class="col-lg-4 col-6">
           <img data-bind="attr: { src: ImagePath() + '/' + image }" alt="img" class="img-fluid">
           <h4 data-bind="text: name"></h4>

         </div>
         <!-- /ko -->

       </div>
     </div>
   </section>

   <section class="testimonials banner-bottom-agile-w3ls py-5">
     <div class="container py-lg-5 py-3">
       <h3 class="heading text-capitalize text-center">Nhận Xét Của Khách Hàng</h3>
       <h5 class="heading mb-5 text-center">catuexpress</h5>
       <div class="inner-sec-w3layouts-agileits">
         <div class="owl-carousel owl-theme">
           <div class="item">
             <div class="feedback-info">
               <div class="feedback-top p-4">
                 <p> Sed semper leo metus, a lacinia eros semper at. Etiam sodales orci sit amet vehicula pellentesque. </p>
               </div>
               <div class="feedback-grids">
                 <div class="feedback-img-info">
                   <p>Anh</p>
                   <h5>Mary Jane</h5>
                 </div>
                 <div class="clearfix"> </div>
               </div>
             </div>
           </div>
           <div class="item">
             <div class="feedback-info">
               <div class="feedback-top p-4">
                 <p> Sed semper leo metus, a lacinia eros semper at. Etiam sodales orci sit amet vehicula pellentesque. </p>
               </div>
               <div class="feedback-grids">
                 <div class="feedback-img-info">
                   <p>Chị</p>
                   <h5>Peter Guptill</h5>
                 </div>
                 <div class="clearfix"> </div>
               </div>
             </div>
           </div>
           <div class="item">
             <div class="feedback-info">
               <div class="feedback-top p-4">
                 <p> Sed semper leo metus, a lacinia eros semper at. Etiam sodales orci sit amet vehicula pellentesque. </p>
               </div>
               <div class="feedback-grids">
                 <div class="feedback-img-info">
                   <p>Anh</p>
                   <h5>Steven Wilson</h5>
                 </div>
                 <div class="clearfix"> </div>
               </div>
             </div>
           </div>
           <div class="item">
             <div class="feedback-info">
               <div class="feedback-top p-4">
                 <p> Sed semper leo metus, a lacinia eros semper at. Etiam sodales orci sit amet vehicula pellentesque. </p>
               </div>
               <div class="feedback-grids">
                 <div class="feedback-img-info">
                   <p>Anh</p>
                   <h5>Mary Jane</h5>
                 </div>
                 <div class="clearfix"> </div>
               </div>
             </div>
           </div>
           <div class="item">
             <div class="feedback-info">
               <div class="feedback-top p-4">
                 <p> Sed semper leo metus, a lacinia eros semper at. Etiam sodales orci sit amet vehicula pellentesque. </p>
               </div>
               <div class="feedback-grids">
                 <div class="feedback-img-info">
                   <p>Anh</p>
                   <h5>Peter Guptill</h5>
                 </div>
                 <div class="clearfix"> </div>
               </div>
             </div>
           </div>
           <div class="item">
             <div class="feedback-info">
               <div class="feedback-top p-4 p-4">
                 <p> Sed semper leo metus, a lacinia eros semper at. Etiam sodales orci sit amet vehicula pellentesque. </p>
               </div>
               <div class="feedback-grids">
                 <div class="feedback-img-info">
                   <p>Chị</p>
                   <h5>Steven Wilson</h5>
                 </div>
                 <div class="clearfix"> </div>
               </div>
             </div>
           </div>
         </div>
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
 </div>
 <!-- //login and register modal -->


 @endsection

 @section('script')
 <script src="{{asset('page_asset/page-index.js')}}"></script>
 <script type="text/javascript">
   $(document).ready(function() {
     var data = {};
     var options = {};
     data.Tours = <?php echo json_encode($Tours); ?>;
     data.Drivers = <?php echo json_encode($Drivers); ?>;
     data.Banners = <?php echo json_encode($Banners); ?>;
     data.Cars = <?php echo json_encode($Cars); ?>;

     options.ImagePath = <?php echo json_encode(asset('/images')); ?>;
     options.PublicPath = <?php echo json_encode(url('')); ?>;

     data.API_URLs = options;
     ko.applyBindings(IndexViewModel(data), document.getElementById("page-home-ko"));
   });
 </script>
 @endsection