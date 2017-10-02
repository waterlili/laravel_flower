<?php

namespace App\Http\Controllers\Adm;

use App\DB\Customer;
use App\DB\Flower;
use App\DB\FlowerPackage;
use App\DB\FlowerPacket;
use App\DB\Order;
use App\DB\PacketType;
use App\DB\User;
use App\DB\UserInfo;
use App\Jobs\RemoveExcelForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller {


  /**
   * AdminController constructor.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  public function getIndex() {
    return view('admin.admin');
  }


  public function getGroupCollection() {
    return view('admin.block.group-collection');
  }

  public function getPrintTable() {
    return view('MD.table.printPage', [
      'record' => session('table_print'),
      'cols' => session('table_cols'),
      'title' => trans('table_print.' . session('table_print_title')),
    ]);
  }

  /**
   * @param \Illuminate\Http\Request $request
   */
  public function getExcelFile(Request $request) {
    if ($request->has('url')) {
      $job = (new RemoveExcelForm($request->input('url')))->delay(60);
      $this->dispatch($job);
      return response()->download(storage_path('app/excel/export') . '/' . $request->input('url'));
    }
    abort(404);
  }


  public function getDashboard() {
    return view('admin.dashboard');
  }

  public function postTestTable(Request $request) {
    $rows = [];
    for ($i = 0; $i < $request->input('count'); $i++) {
      $rows[] = [
        'col1' => uniqid('col1_'),
        'col2' => uniqid('col2_'),
        'col3' => uniqid('col3_'),
        'col4' => uniqid('col1_4'),
      ];
    }
    $export = [
      'rows' => $rows,
      'total' => 100
    ];
    return response()->json($export);
  }


  public function postEditDialog(Request $request) {
    if (method_exists($this, 'edit' . studly_case($request->input('where')))) {
      return $this->{'edit' . studly_case($request->input('where'))}($request);
    }
    return abort(404);
  }

  public function postDestroy(Request $request) {
    if (method_exists($this, 'des' . studly_case($request->input('where')))) {
      return $this->{'des' . studly_case($request->input('where'))}($request);
    }
    return abort(404);
  }

  protected function desUser(Request $request) {
    $input = $request->all();
    $user = User::find($input['id']);
    if (in_array($user->email, config('superuser'))) {
      return response()->json(['errorItem' => [trans('validation.superuser')]], 422);
    }
    Customer::find($user->cid)->delete();
    $user->delete();
    return response()->json(TRUE);
  }

  protected function desCustomer(Request $request) {
    $input = $request->all();
    User::find($input['id'])->delete();
    return response()->json(TRUE);
  }

    protected function desPackageTypes(Request $request)
    {
        $input = $request->all();
        PacketType::find($input['id'])->delete();
        return response()->json(TRUE);
    }

    /**
     * Delete flowers from database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function desFlowers(Request $request) {
    $input = $request->all();
    Flower::find($input['id'])->delete();
    return response()->json(TRUE);
  }

    /**
     * Delete Flower packages from database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function desFlowerPackages(Request $request) {
    $input = $request->all();
    FlowerPackage::find($input['id'])->delete();
    return response()->json(TRUE);
  }

    /**
     * Delete Flower packets from database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function desFlowerPackets(Request $request) {
    $input = $request->all();
    FlowerPacket::find($input['id'])->delete();
    return response()->json(TRUE);
  }


  protected function editUser(Request $request) {
    $input = $request->all();
    User::find($input['id'])->update($input['data']);
    return response()->json(TRUE);
  }


  protected function editCustomer(Request $request) {
    $input = $request->all();
//    $input['data']['user_info'] = NULL;
    User::find($input['id'])->update($input['data']);

    $ui = [];
    foreach ([
               'job',
               'job_type',
               'skill',
               'address',
               'address2',
               'zip_code',
               'phone',
               'mobile',
               'sts',
               'att_type',
               'attraction',
               'description',
             ] as $item) {
      if (!is_null($input['data'][$item])) {
        $ui[$item] = $input['data'][$item];
      }
    }
    UserInfo::whereUid($input['id'])->update($ui);

    return response()->json(TRUE);
  }

  protected function editOrder(Request $request) {
    $input = $request->all();
    foreach (['visitor', 'sender', 'customer'] as $item) {
      if (isset($input['data'][$item]) && !is_null($input['data'][$item])) {
        if ($item == 'customer') {
          $input['data']['uid'] = $input['data'][$item]['id'];
        }
        else {
          $input['data'][$item] = $input['data'][$item]['id'];
        }
      }
    }
    Order::find($input['id'])->update($input['data']);
    return response()->json(TRUE);
  }

  protected function desOrder(Request $request) {
    $input = $request->all();
    Order::find($input['id'])->delete();
    return response()->json(TRUE);
  }

}
