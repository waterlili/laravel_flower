<?php

namespace App\Http\Controllers\Auth;

use App\DB\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  protected $redirectPath = '/console';
  protected $redirectTo = '/console';
  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
  public function __construct() {
    if (Session::has('_path')) {
      $this->redirectPath = Session::get('_path');
    }
    $this->middleware('guest', [
      'except' => [
        'getLogout',
        'getResetPassword',
        'postResetPassword'
      ]
    ]);
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|confirmed|min:6',
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array $data
   * @return User
   */
  protected function create(array $data) {
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
    ]);
  }


  protected function validatorLogin(array $data) {
    return Validator::make($data, [
      'email' => 'required|email|max:255',
      'password' => 'required|max:255'
    ]);
  }

  public function postRegister(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      $this->throwValidationException(
        $request, $validator
      );
    }
    $activation_code = str_random(60) . $request->input('email');
    $user = new User;
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    //$user->activation_code = $activation_code
    if ($user->save()) {
      $data = array(
        'name' => $user->name,
        'email' => $user->email,
        'code' => $activation_code,
      );
      Mail::queue('auth.verify_email', $data, function ($message) use ($user) {
        $message->to($user->email, $user->name)
          ->subject('فعال سازی حساب کاربری شما در رویش');
      });
      Mail::queue('auth.admin_alert', $data, function ($message) use ($user) {
        $message->to('ar.azizan@gmail.com', $user->name)
          ->subject('فعال سازی حساب کاربری شما در رویش');
      });
      return response()->json(TRUE);
    }
    else {
      Session::flash('message', 'مشکلی در فرآیند ساخت پیش آمده');
      return response([FALSE], 400);
    }
  }


  public function getLogout() {
    Auth::logout();
    return redirect()->back();
  }

  public function postLogin(Request $request) {

    $validator = $this->validatorLogin($request->all());
    if ($validator->fails()) {
      $this->throwValidationException(
        $request, $validator
      );
    }
    $data = $request->all();
    if (!isset($data['remember'])) {
      $data['remember'] = FALSE;
    }
    if (Auth::attempt([
      'email' => $data['email'],
      'password' => $data['password']
    ], $data['remember'])
    ) {
      if (Auth::user()->active == 0) {
        Auth::logout();
        return response([FALSE], 406);
      }
      return response([
        'result' => TRUE,
        'redirectPath' => url($this->redirectPath)
      ]);
    }
    return response([FALSE], 401);
  }

  public function getActivate($code, User $user) {
    $user->accountIsActive($code);
  }


  public function getResetPassword() {
    return view('auth.passreset');
  }

  public function postResetPassword() {
    $input = Input::get();

    if (isset($input['data']) && Auth::attempt([
        'email' => Auth::user()->email,
        'password' => $input['data']['old']
      ])
    ) {
      $user = User::findOrFail(Auth::user()->id)
        ->update(['password' => Hash::make($input['data']['new'])]);
      return response()->json(TRUE);
    }
    else {
      return response('', 406)->json(FALSE);
    }
  }
}
