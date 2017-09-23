<?php

namespace App\Http\Controllers\Adm;

use App\DB\Customer;
use App\DB\CustomerGroup;
use App\DB\Group;
use App\DB\IBAN;
use App\DB\Order;
use App\DB\User;
use App\DB\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller {
  //
  /**
   * CustomerConroller constructor.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  public function getList() {
    return view('admin.page.customer.list');
  }

  public function getAdd() {
    return view('admin.page.customer.add');
  }

  public function getGroup() {
    return view('admin.page.customer.group');
  }

  public function getEdit() {
    return view('admin.page.customer.edit');
  }

  public function getIbanInfo($id) {
    return view('admin.page.customer.block.ibanInfo', ['id' => $id]);
  }


  public function postList(Request $request) {
    $record = User::customer()->with('user_info');
    $record = $record->select(array_merge([
      '*',
      User::$SELECT__GENDER_STR,
      User::$SELECT__ACTIVE_STR,
      User::$SELECT__CUS_TYPE_STR,
      User::$SELECT__STS_STR,
    ], UserInfo::$selectCUJ));
    return $this->tableEngine($record, $request->all());
  }


  public function postGetGroups(Request $request) {
    $group = Group::whereParent(NULL)->with('child')->get()->toArray();
    return response(['result' => TRUE, 'data' => $group]);
  }

  public function postAddGroup(Request $request) {
    $this->validate($request, [
      'title' => 'required|unique:group'
    ]);
    Group::create($request->all());
    return response(['result' => TRUE]);
  }

  public function postGetIdenInfo(Request $request) {
    $this->validate($request, [
      'id' => 'required|numeric'
    ]);
    $record = IBAN::where('cid', $request->input('id'))->get();
    return response()->json($record);
  }


  public function postAdd(Request $request) {
    $input = $request->all();
    $user = User::create($input);

    UserInfo::create(array_merge(['uid' => $user->id], $input));
    if (isset($input['groups']) && is_array($input['groups'])) {
      foreach ($input['groups'] as $item) {
        CustomerGroup::create([
          'group' => $item,
          'customer' => $user->id
        ]);
      }
    }

    
    return response()->json(['result' => TRUE , 'id'=>$user->id]);
  }


  public function postSearchGroups(Request $request) {
    $input = $request->all();
    $group = Group::where('title', 'LIKE', '%' . $input['textSearch'] . '%')
      ->take(10)
      ->select(['id', 'title as value'])
      ->get();
    return response()->json($group);
  }

  public function postSearchCustomers(Request $request) {
    $input = $request->all();
    $group = User::customer()
      ->where(function ($q) use ($input) {
        $q->where('fname', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('lname', 'LIKE', '%' . $input['textSearch'] . '%');
      })
      ->take(10)
      ->select(['id', DB::raw('CONCAT(fname , " " , lname) as value')])
      ->get();
    return response()->json($group);
  }


  public function postSetGroups(Request $request) {
    $this->validate($request, [
      'groups' => 'required',
      'customers' => 'required'
    ]);
    $input = $request->all();

    foreach ($input['customers'] as $customer) {
      foreach ($input['groups'] as $group) {
        CustomerGroup::firstOrCreate(
          [
            'group' => $group['id'],
            'customer' => $customer['id']
          ]
        );
      }
    }
    return response()->json(['result' => TRUE]);
  }

  public function postGetOrderData(Request $request) {
    $input = $request->all();

  }


  protected function bfnPayment($record) {
    $record->where('sts', 2);
  }

  protected function bfnDebts($record) {
    $record->where('sts', 2);
  }

  protected function bfnUnpaid($record) {
    $record->where('sts', 2);
  }


  public function postOrderList(Request $request) {
    $input = $request->all();
    $record = Order::whereUid($input['uid'])
      ->select(
        [
          '*',
          'created_at as created_at_j',
          'updated_at as updated_at_j',
          'closed_at as closed_at_j',
          'sts as sts_str',
          'type as type_str',
          'day as day_str',
          'when as when_str',
        ]
      );
    return $this->tableEngine($record, $input);
  }

  public function getGetOrderData() {

    return view('admin.page.customer.block.order-dialog');
  }

  public function postGetFactsData(Request $request) {
    $input = $request->all();
    $order = Order::where('uid', $input['uid']);
    $paid = $order->where('sts', 1)->count();
    $get = $order->where('sts', 1)->sum('price');
    $unpaid = Order::where('uid', $input['uid'])->where('sts', -1)->count();
    $debt = Order::where('uid', $input['uid'])->where('sts', -1)->sum('price');
    $loyality = ($paid * 100) / ($paid + $unpaid);
    return response()->json([
      'result' => TRUE,
      'facts' => [
        'paid' => $paid,
        'unpaid' => $unpaid,
        'loyalty' => $loyality,
        'get' => $get,
        'debt' => $debt
      ]
    ]);
  }
}
