<?php

namespace App\Http\Controllers\Adm;

use App\DB\Cnt;
use App\DB\FlowerPacket;
use App\DB\Log;
use App\DB\Permission;
use App\DB\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManageController extends Controller {
  public function getUsers() {
    return view('admin.page.manage.user.user');
  }

  public function getUserEdit() {
    return view('admin.page.manage.user.user_edit_dialog');
  }

  public function getConst() {
    return view('admin.page.manage.const.const');
  }

  public function getLog() {
    return view('admin.page.manage.log.log');
  }


  public function postLog(Request $request) {
    $record = Log::select(['*', 'type as type_str'])->with('user_full_name');
    return $this->tableEngine($record, $request->all());
  }

  public function postGetConstFlower() {
    $json = Cnt::flower()->get();
    return response()->json(['result' => TRUE, 'data' => $json]);
  }

  public function postGetConstCost() {
    $json = Cnt::cost()->get();
    return response()->json(['result' => TRUE, 'data' => $json]);
  }

  public function postGetConstUserType() {
    $json = Cnt::usertype()->get();
    return response()->json(['result' => TRUE, 'data' => $json]);
  }

    public function postGetConstFlowerPacket()
    {
        $json = FlowerPacket::GetPckt();
        return response()->json(['result' => TRUE, 'data' => $json]);
    }
  public function postSetConstUserType(Request $request) {
    return $this->_setConst($request, Cnt::$USERTYPE);
  }

  public function postSetConstFlower(Request $request) {
    return $this->_setConst($request, Cnt::$FLOWER);
  }

    public function postSetConstFlowerPacket(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
        ]);
        FlowerPacket::create(['title' => $request->input('title'), 'price' => $request->input('price')]);
        return response()->json(['result' => TRUE]);
    }

  public function postSetConstPack(Request $request) {
    $this->_setConst($request, Cnt::$PACK);
  }

  public function postSetConstCost(Request $request) {
    $this->_setConst($request, Cnt::$COST);
  }


  public function _setConst(Request $request, $w) {
    $this->validate($request, [
      'title' => 'required|unique:const'
    ]);
    Cnt::create(['title' => $request->input('title'), 'w' => $w]);
    return response()->json(['result' => TRUE]);
  }

  public function postGetConstPack() {
    $json = Cnt::pack()->get();
    return response()->json(['result' => TRUE, 'data' => $json]);
  }


  protected static function count_slash($str) {
    return substr_count($str, '/');
  }

  protected static function replace_slash($str) {
    $original = explode('/', $str);


    return join('.children.', $original);
//    return str_replace('/', '.', $str);
  }

  public function postGetRoles(Request $request) {
    $this->validate($request, [
      'user_type' => 'required'
    ]);
    $config = \Illuminate\Support\Facades\Config::get('roles');
    $export = [];
    $perm = Permission::where('utid', $request->input('user_type'))
      ->get()
      ->toArray();
    $perm = array_pluck($perm, 'rid');
    foreach ($config as $key => $val) {
      $i = [
        '_rid' => $val,
        '_count' => self::count_slash($key),
        '_address' => trans('role.' . $key),
      ];
      if (in_array($i['_rid'], $perm)) {
        $i['has'] = TRUE;
      }
      array_set($export, self::replace_slash($key), $i);
    }
    return response()->json($export);

  }

  public function getRoles() {
    return view('admin.page.manage.role.role');
  }

  public function postUserAdd(Request $request) {
    $this->validate($request, [
      'fname' => 'required',
      'email' => 'required|email|unique:users',
      'lname' => 'required',
      'username' => 'required|unique:users',
      'password' => "required",
      'type' => 'required|numeric'
    ]);

    $input = $request->all();
    if (isset($input['personal']) && isset($input['personal']['url'])) {
      $input['personal_picture'] = $input['personal']['url'];
    }
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);
    $user->password = $input['password'];
    $user->save();
    return response()->json(['result' => TRUE]);
  }

  public function postActiveUser(Request $request) {
    $this->validate($request, [
      'id' => 'required',
      'active' => 'required'
    ]);

    User::find($request->input('id'))
      ->update(['active' => $request->input('active')]);
    return response()->json(['result' => TRUE]);
  }

  public function postUserList(Request $request) {
    $records = User::employer()->select(['*', 'type as type_str']);
    return $this->tableEngine($records, $request->all());
  }


  public function postUserUploadFile(Request $request) {
    $path = 'avatars/' . $request->user()->id . '.' . $request->file('file')
        ->getClientOriginalExtension();
    Storage::disk('public')->put(
      $path,
      file_get_contents($request->file('file')->getRealPath())
    );

    return response()->json(['url' => Storage::disk('public')->url($path)]);
  }


  public function getRoleListTemplate() {
    return view('admin.page.manage.role.block.list_template');
  }

  public function postSetRoles(Request $request) {
    $this->validate($request, [
      'user_type' => 'required|numeric',
      'export' => 'required'
    ]);
    $input = $request->all();
    Permission::where('utid', $input['user_type'])->delete();
    foreach ($input['export'] as $item) {
      Permission::create(['utid' => $input['user_type'], 'rid' => $item]);
    }
    return response()->json(['result' => TRUE]);
  }
}
