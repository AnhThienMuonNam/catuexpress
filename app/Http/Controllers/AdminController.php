<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\User;

class AdminController extends Controller
{
  public function loginView()
  {
    if (!Auth::check()) {
      return view('admin.login');
    } else {
      return redirect(config('constants.ADMIN_PREFIX') . '/order');
    }
  }

  public function login(Request $request)
  {
    $this->validate($request, ['Email' => 'required', 'Password' => 'required'], [
      'Email.required' => 'Bạn chưa nhập email',
      'Password.required' => 'Bạn chưa nhập mật khẩu',

    ]);

    $user = User::where('email', $request->Email)->first();
    if ($user !== null) {
      if (Auth::attempt(['email' => $request->Email, 'password' => $request->Password])) {

        return response()->json(['IsSuccess' => true]);
      }
    } else {
      return response()->json(['IsSuccess' => false]);
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect(config('constants.ADMIN_PREFIX') . '/login');
  }
}
