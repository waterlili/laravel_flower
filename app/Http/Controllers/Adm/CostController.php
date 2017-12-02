<?php

namespace App\Http\Controllers\Adm;

use App\DB\Cnt;
use App\DB\Cost;
use App\DB\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CostController extends Controller {

  /**
   * CostController constructor.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  public function getIndex() {
    return view('admin.page.cost.cost');
  }


    public function getTest()
    {
        return view('admin.page.test.test');
    }


    public function postTest(Request $request)
    {
        $input = $request->all();
        return response()->json(['sasasas'], 422);
        dd($input);
    }

  public function postList(Request $request) {
    $record = Cost::select([
      '*',
      'sts as sts_str',
      'created_at as created_at_j',
      'updated_at as updated_at_j',
    ])->with('user_full_name')->with('reviewer_full_name');
    return $this->tableEngine($record, $request->all());
  }


  public function postUidList(Request $request) {
    $input = $request->all();
    $record = User::employer()
      ->where('fname', 'LIKE', '%' . $input['textSearch'] . '%')
      ->where('lname', 'LIKE', '%' . $input['textSearch'] . '%')
      ->select(['id', DB::raw('CONCAT(fname, " ",lname) as value')])
      ->get();
    return response()->json($record);
  }


  public function postParentList(Request $request) {
    $input = $request->all();
    $record = Cost::
    where('title', 'LIKE', '%' . $input['textSearch'] . '%')
      ->where('id', 'LIKE', '%' . $input['textSearch'] . '%')
      ->select(['id', DB::raw('CONCAT(title, "( ",id," )") as value')])
      ->get();
    return response()->json($record);
  }


  public function postAdd(Request $request) {
    $this->validate($request, [
      'title' => "required",
      'price' => 'required'
    ]);
    $input = $request->all();
    if (!is_null($input['uid'])) {
      $input['uid'] = $input['uid']['id'];
    }

    if (!is_null($input['parent'])) {
      $input['parent'] = $input['parent']['id'];
    }
    Cost::create($input);
    return response()->json(['result' => TRUE]);
  }

}
