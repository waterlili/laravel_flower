<?php

namespace App\Http\Controllers;

use App\DB\Customer;
use App\DB\IBAN;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PublicController extends Controller {
  public function getIndex() {
//    dd(Hash::make('12563'));
    return redirect('console');
  }

  public function getNode() {
    return view('public.node');
  }


  public function getSignUp() {
    return view('public.signup');
  }


    public function getMigrate()
    {
        Artisan::call('migrate');
        return response()->json(true);
    }


  public function postCheckAuth() {
    return response()->json(Auth::check());
  }

  public function postSignUp(Request $request) {
    $this->validate($request, [
      'captcha' => "required|captcha",
      'fname' => 'required|max:255',
      'lname' => 'required|max:255',
      'mobile' => 'required|numeric',
      'email' => 'required|unique:customer',
      'ncode' => 'required|unique:customer',
      'iban' => 'required'
    ]);
    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $input['username'] = $input['email'];
    $record = Customer::create($input);
    IBAN::create([
      'iban' => $input['iban'],
      'fname' => $input['fname'],
      'lname' => $input['lname'],
      'cid' => $record->id
    ]);

    return response()->json(['result' => TRUE]);

  }

  public function postGetCurrency() {
    return config('currency');
  }


  public function postGetCaptcha(Request $request) {
    return response()->json(captcha_src('flat'));
  }
}
