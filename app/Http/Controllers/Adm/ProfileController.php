<?php

namespace App\Http\Controllers\Adm;

use App\DB\SysLog;
use App\DB\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
  public function getLastLogin(Request $request) {
    $log = SysLog::whereMessage('user-login')
      ->whereUid(Auth::user()->id)
      ->select(['*', 'created_at as created_at_j'])
      ->orderBy('created_at', 'DESC')
      ->take(10)
      ->get();
    return view('admin.page.profile.last_entrance', ['log' => $log]);
  }

  public function getSettings() {

    return view('admin.page.profile.settings');
  }


  public function postUploadProfileImage(Request $request) {
    $destination = 'uploads/user/profile/';
    $file = $request->file('file');
    $ext = $file->getClientOriginalExtension();
    $input = $request->all();
    if (isset($input['uid'])) {
      $user = User::find($input['uid']);
    }
    else {
      $user = Auth::user();
    }
    $email = $user->email;
    $file->move($destination, $email . '.' . $ext);
    $user
      ->update(['personal_picture' => $destination . $email . '.' . $ext]);
    return response([
      'result' => TRUE,
      'url' => $destination . $email . '.' . $ext
    ]);

  }

  public function postGetUserData(Request $request) {
    return response(Auth::user());
  }

  public function postEdit(Request $request) {
    Auth::user()->update($request->all());
    return response()->json(['result' => TRUE]);
  }


  public function postChangePassword(Request $request) {
    $this->validate($request, [
      'old' => 'required',
      'new' => 'required',
    ]);

    if (Hash::check($request->input('old'), Auth::user()->password)) {
      Auth::user()->password = Hash::make($request->input('new'));
      Auth::user()->save();
      return response()->json(['result' => TRUE]);
    }
    return response()->json(['confirm' => ['کلمه عبور قبلی اشتباه است.']], 422);
  }
}
