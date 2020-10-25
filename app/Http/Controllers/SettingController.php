<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Driver;
use App\Tour;
use App\Car;

use File;

class SettingController extends Controller
{
  public function getAdvisoryView()
  {
    return view('admin.setting.advisory');
  }

  public function getAllDrivers()
  {
    $Drivers = Driver::where('is_deleted', 0)->get();
    return view('admin.setting.driver', ['Drivers' => $Drivers]);
  }

  public function editDriver(Request $request)
  {
    try {
      $this->validate(
        $request,
        [
          'name' => 'required',
          'email' => 'required',
          'phone' => 'required',
        ],
        [
          'name.required' => 'Tên',
          'email.required' => 'Email',
          'phone.required' => 'SĐT',
        ]
      );

      $model = Driver::find($request->id);
      $model->name = $request->name;
      $model->email = $request->email;
      $model->phone = $request->phone;
      $model->is_active = $request->is_active;
      $model->home_page_show = $request->home_page_show;
      $model->image = $request->image;
      $model->save();

      return response()->json(['IsSuccess' => true]);
    } catch (Exception $ex) {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function createDriver(Request $request)
  {
    try {
      $this->validate(
        $request,
        [
          'name' => 'required',
          'email' => 'required',
          'phone' => 'required',
        ],
        [
          'name.required' => 'Tên',
          'email.required' => 'Email',
          'phone.required' => 'SĐT',
        ]
      );

      $model = new Driver();
      $model->name = $request->name;
      $model->email = $request->email;
      $model->phone = $request->phone;
      $model->image = $request->image;
      $model->is_active = $request->is_active;
      $model->home_page_show = $request->home_page_show;
      $model->save();
      return response()->json(['IsSuccess' => true]);
    } catch (Exception $ex) {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function deleteDriver(Request $request)
  {
    $driver = Driver::find($request->id);
    $driver->is_deleted = 1;
    $driver->save();
    return response()->json(['IsSuccess' => true]);
  }

  public function uploadSingleImage(Request $request)
  {
    $imageName = time() . '.' . $request->uploadFile->getClientOriginalExtension();
    $request->uploadFile->move(public_path() . '/images/', $imageName);
    $response = $imageName;
    return $response;
  }

  public function deleteSingleImage(Request $request)
  {
    $image_path = public_path() . '/images/' . $request->deleteFile;
    unlink($image_path);
  }

  public function getAllTours()
  {
    $Tours = Tour::where('is_deleted', 0)->get();
    return view('admin.setting.tour', ['Tours' => $Tours]);
  }

  public function editTour(Request $request)
  {
    try {
      $this->validate(
        $request,
        [
          'title' => 'required|max:100',
          'image' => 'required',
          'price' => 'required',
        ],
        [
          'title.required' => 'Bạn chưa nhập tên',
          'title.max' => 'Tên phải ít hơn 100 ký tự',
          'price.required' => 'Bạn chưa nhập giá',
          'image.required' => 'Bạn chưa chọn hình ảnh'
        ]
      );

      $model = Tour::find($request->id);
      $model->title = $request->title;
      $model->price = $request->price;
      $model->description = $request->description;
      $model->is_active = $request->is_active;
      $model->home_page_show = $request->home_page_show;
      $model->image = $request->image;
      $model->save();

      return response()->json(['IsSuccess' => true]);
    } catch (Exception $ex) {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function createTour(Request $request)
  {
    try {
      $this->validate(
        $request,
        [
          'title' => 'required|max:100',
          'image' => 'required',
          'price' => 'required',
        ],
        [
          'title.required' => 'Bạn chưa nhập tên',
          'title.max' => 'Tên phải ít hơn 100 ký tự',
          'price.required' => 'Bạn chưa nhập giá',
          'image.required' => 'Bạn chưa chọn hình ảnh'
        ]
      );

      $model = new Tour();
      $model->title = $request->title;
      $model->price = $request->price;
      $model->description = $request->description;
      $model->image = $request->image;
      $model->is_active = $request->is_active;
      $model->home_page_show = $request->home_page_show;
      $model->save();
      return response()->json(['IsSuccess' => true]);
    } catch (Exception $ex) {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function deleteTour(Request $request)
  {
    $tour = Tour::find($request->id);
    $tour->is_deleted = 1;
    $tour->save();
    return response()->json(['IsSuccess' => true]);
  }


  public function getAllCars()
  {
    $Cars = Car::where('is_deleted', 0)->get();
    return view('admin.setting.car', ['Cars' => $Cars]);
  }

  public function editCar(Request $request)
  {
    try {
      $this->validate(
        $request,
        [
          'name' => 'required|max:100',
          'image' => 'required'
        ],
        [
          'name.required' => 'Bạn chưa nhập tên',
          'name.max' => 'Tên phải ít hơn 100 ký tự',
          'image.required' => 'Bạn chưa chọn hình ảnh'
        ]
      );

      $model = Car::find($request->id);
      $model->name = $request->name;
      $model->is_active = $request->is_active;
      $model->home_page_show = $request->home_page_show;
      $model->image = $request->image;

      $model->save();

      return response()->json(['IsSuccess' => true]);
    } catch (Exception $ex) {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function createCar(Request $request)
  {
    try {
      $this->validate(
        $request,
        [
          'name' => 'required|max:100',
          'image' => 'required',
        ],
        [
          'name.required' => 'Bạn chưa nhập tên',
          'name.max' => 'Tên phải ít hơn 100 ký tự',
          'image.required' => 'Bạn chưa chọn hình ảnh'
        ]
      );

      $model = new Car();
      $model->name = $request->name;
      $model->image = $request->image;
      $model->is_active = $request->is_active;
      $model->home_page_show = $request->home_page_show;
      $model->save();
      return response()->json(['IsSuccess' => true]);
    } catch (Exception $ex) {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function deleteCar(Request $request)
  {
    $car = Car::find($request->id);
    $car->is_deleted = 1;
    $car->save();
    return response()->json(['IsSuccess' => true]);
  }
}
