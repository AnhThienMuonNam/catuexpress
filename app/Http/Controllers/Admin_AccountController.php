<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Hash;
use App\User;
use App\City;
use App\Lichsu_Tracuu;
use App\Permissions;

class Admin_AccountController extends Controller
{
  public function getAllUsers()
  {
    $Users = User::orderBy('name', 'desc')->get();
    return view('admin.user_index', ['Users' => $Users]);
  }

  public function createUserView()
  {
    return view('admin.user_create');
  }

  public function createUser(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|unique:users',
      'password' => 'required|min:6|max:20',
    ], [
      'name.required' => 'Bạn chưa nhập Họ tên',
      'email.required' => 'Bạn chưa nhập email',
      'email.unique' => 'Email đã tồn tại',
      'password.required' => 'Bạn chưa nhập mật khẩu',
      'password.min' => 'Mật khẩu mới phải lớn hơn hoặc bằng 6 ký tự',
      'password.max' => 'Mật khẩu mới phải nhỏ hơn hoặc bằng 20 ký tự',
    ]);

    $model = new User;
    $model->name = $request->name;
    $model->email = $request->email;
    $model->password = bcrypt($request->password);
    $model->is_admin = $request->is_admin;
    $model->save();

    return response()->json(['IsSuccess' => true, 'UserId' => $model->id]);
  }

  public function editUserView($Id)
  {
    $User = User::find($Id);
    return view('admin.user_edit', ['user' => $User]);
  }

  public function editUserPost(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|max:50'
    ], [
      'name.required' => 'Bạn chưa nhập họ tên',
      'name.max' => 'Họ tên phải ít hơn 50 ký tự'
    ]);

    $model = User::find($request->id);
    $model->name = $request->name;
    $model->is_admin = $request->is_admin;

    $model->save();

    return response()->json(['IsSuccess' => true]);
  }

  public function changePasswordPost(Request $request, $Id)
  {
    $this->validate($request, [
      'OldPassword' => 'required',
      'NewPassword' => 'required|min:6|max:20',
      'NewPasswordx2' => 'required|same:NewPassword',
    ], [
      'OldPassword.required' => 'Bạn chưa nhập mật khẩu cũ',
      'NewPassword.required' => 'Bạn chưa nhập mật khẩu mới',
      'NewPassword.min' => 'Mật khẩu mới phải lớn hơn hoặc bằng 6 ký tự',
      'NewPassword.max' => 'Mật khẩu mới phải ít hơn hoặc bằng 20 ký tự',
      'NewPasswordx2.required' => 'Bạn chưa nhập xác nhận mật khẩu mới',
      'NewPasswordx2.same' => 'Mật khẩu mới không trùng nhau'
    ]);
    // bcrypt($request->Password);
    $current_password = Auth::User()->password;
    if (Hash::check($request->OldPassword, $current_password)) {
      $user_id = Auth::User()->id;
      $obj_user = User::find($user_id);
      $obj_user->password = bcrypt($request->NewPassword);
      $obj_user->save();
      return redirect(config('constants.ADMIN_PREFIX') . '/account/' . $Id)->with('message', 'Đổi mật khẩu thành công');
    } else {
      return redirect(config('constants.ADMIN_PREFIX') . 'account/' . $Id)->with('errorMessage', 'Mật khẩu cũ không đúng');
    }
  }

  public function getAllPermissions()
  {
    if (!\AppHelper::instance()->hasPermission('OWNER')) {
      return view('admin.unauthorized');
    }
    $adminPermissions = Permissions::where('is_active', 1)->get(['code']);
    $Permissions = Permissions::all();
    return view('admin.permissions', ['Permissions' => $Permissions, 'adminPermissions' => $adminPermissions]);
  }

  public function editPermissionsPost(Request $request)
  {
    if (!\AppHelper::instance()->hasPermission('OWNER')) {
      return response()->json(['IsSuccess' => false]);
    }

    $active =  Permissions::whereIn('id', $request->active_permissions)->update(['is_active' => 1]);
    $inactive =  Permissions::whereNotIn('id', $request->active_permissions)->update(['is_active' => 0]);

    return response()->json(['IsSuccess' => true]);
  }
}
