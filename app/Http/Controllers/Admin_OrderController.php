<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Hash;
use Mail;
use DateTime;

use App\User;
use App\Order;
use App\Driver;
use App\Tour;
use App\Order_Status;
use App\About_Us;

class Admin_OrderController extends Controller
{
    public function createOrderView()
    {
        return view('admin.order_create');
    }

    public function createOrder()
    {
        return view('admin.order_create');
    }

    public function getAllOrders()
    {
        $OrderStatuses = Order_Status::all();
        $Drivers = Driver::where('is_deleted', 0)->get();
        $Tours = Tour::where('is_deleted', 0)->get();

        return view('admin.order_index', [
            'OrderStatuses' => $OrderStatuses,
            'Drivers' => $Drivers,
            'Tours' => $Tours
        ]);
    }

    public function searchOrder(Request $request)
    {
        $result = Order::with('order_status')
            ->with('driver')
            ->with('tour')
            ->orderBy('created_at', 'desc');

        if ($request->keyword) {
            $result = $result->where('customer_name', 'like', '%' . $request->keyword . '%')
                ->orwhere('customer_email', 'like', '%' . $request->keyword . '%')
                ->orwhere('customer_phone', 'like', '%' . $request->keyword . '%');
        }

        if ($request->id) {
            $result = $result->where('id', $request->id);
        }
        if ($request->orderStatusId) {
            $result = $result->where('order_status_id', $request->orderStatusId);
        }
        if ($request->fromDate != null) {
            $result = $result->whereDate('created_at', '>=', new DateTime($request->fromDate));
        }
        if ($request->toDate != null) {
            $result = $result->whereDate('created_at', '<=', new DateTime($request->toDate));
        }
        if ($request->tourId) {
            $result = $result->where('tour_id', $request->tourId);
        }
        if ($request->driverId) {
            $result = $result->where('tour_id', $request->driverId);
        }

        $result = $result->get();

        return response()->json(['Orders' => $result]);
    }

    public function sendEmailRemindOrder(Request $request)
    {
        $Order = Order::with('order_status')
            ->with('driver')
            ->with('tour')
            ->where('id', $request->id)
            ->first();

        $contentEmail = [
            'order' => $Order,
            'about_us' => About_Us::orderBy('created_at', 'desc')->first()
        ];

        $customerEmail = $Order->customer_email;
        $driverEmail =  $Order->driver->email;
        $orderId = $Order->id;
        $tourName = $Order->tour->title;

        Mail::send('page.layout.template.order_reconfirmed', [
            'contentEmail' => $contentEmail
        ], function ($message) use ($customerEmail, $tourName, $orderId, $driverEmail) {
            $message->to($customerEmail, 'Customer')
                ->cc([$driverEmail])
                ->subject('CatuExpress - Thông tin đặt chuyến: ' . $tourName . ' (Mã: ' . $orderId . ')');
        });

        return response()->json(['IsSuccess' => true]);
    }

    public function orderDetailView(Request $request, $Id)
    {
        $Order = Order::with('order_status')
            ->with('driver')
            ->with('tour')
            ->where('id', $Id)
            ->first();

        $OrderStatues = Order_Status::all();
        $Drivers = Driver::where('is_deleted', 0)->get();

        return view('admin.order_edit', [
            'Order' => $Order,
            'OrderStatues' => $OrderStatues,
            'Drivers' => $Drivers
        ]);
    }

    public function editOrder(Request $request)
    {
        $model = Order::find($request->id);
        $model->order_status_id = $request->order_status_id;
        $model->detail = $request->detail;
        $model->driver_id = $request->driver_id;
        $model->price = $request->price;
        $model->car_model = $request->car_model;
        $model->save();

        return response()->json(['IsSuccess' => true]);
    }
}
