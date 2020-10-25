<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Hash;
use Mail;
use Carbon\Carbon;
use App\Driver;
use App\Tour;
use App\Order;
use App\About_Us;
use App\Banner;
use App\Car;

use Session;

class HomeController extends Controller
{

  public function homeView()
  {
    $Banners = Banner::all();
    $Drivers = Driver::where('is_deleted', 0)->where('is_active', 1)->where('home_page_show', 1)->get();
    $Tours = Tour::where('is_deleted', 0)->where('is_active', 1)->where('home_page_show', 1)->get();
    $Cars = Car::where('is_deleted', 0)->where('is_active', 1)->where('home_page_show', 1)->get();

    return view('page.index', [
      'Tours' => $Tours,
      'Drivers' => $Drivers,
      'Banners' => $Banners,
      'Cars' => $Cars
    ]);
  }

  public function createOrder(Request $request)
  {
    $this->validate(
      $request,
      [
        'car_type' => 'required',
        'customer_email' => 'required',
        'customer_name' => 'required',
        'customer_phone' => 'required',
        'no_of_passengers' => 'required',
        'pick_up_location' => 'required',
        'pick_up_time' => 'required',
        'tour_id' => 'required'
      ],
      [
        'car_type.required' => 'Loại xe',
        'customer_email.required' => 'Email',
        'customer_name.required' => 'Họ tên',
        'customer_phone.required' => 'SĐT',
        'no_of_passengers.required' => 'Số hành khách',
        'pick_up_location.required' => 'Nơi đón',
        'pick_up_time.required' => 'Thời gian đón',
        'tour_id.required' => 'Tour'
      ]
    );

    $model = new Order();
    $model->customer_name = $request->customer_name;
    $model->customer_email = $request->customer_email;
    $model->customer_phone = $request->customer_phone;
    $model->no_of_passengers = $request->no_of_passengers;
    $model->pick_up_location = $request->pick_up_location;
    $model->pick_up_time = Carbon::parse($request->pick_up_time);
    $model->tour_id = $request->tour_id;
    $model->price = $request->price;
    $model->car_type = $request->car_type;
    $model->order_status_id = 1; //TODO

    $model->save();

    $about_us = About_Us::orderBy('created_at', 'desc')->first();
    $orderId = $model->id;
    $customerEmail =  $model->customer_email;
    // $adminEmail =  $about_us->email;
    $adminEmail =  "xtthien@gmail.com";

    $tourTitle = $request->tour_title;

    $contentEmail = [
      'order' => $model,
      'about_us' => $about_us,
      "tourTitle" => $tourTitle
    ];

    Mail::send('page.layout.template.order_info', [
      'contentEmail' => $contentEmail
    ], function ($message) use ($customerEmail, $adminEmail, $tourTitle, $orderId) {
      $message->to($customerEmail, 'Customer')
        ->cc([$adminEmail])
        ->subject('CatuExpress - Xác nhận đặt chuyến: ' . $tourTitle . ' (Mã: ' . $orderId . ')');
    });

    return response()->json(['IsSuccess' => true]);
  }

  public function tourView()
  {
    $Tours = Tour::all();
    return view('page.tour', ['Tours' => $Tours]);
  }
}
