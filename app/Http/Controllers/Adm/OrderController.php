<?php

namespace App\Http\Controllers\Adm;


use App\DB\Cnt;
use App\DB\Customer;
use App\DB\Order;
use App\DB\OrderDay;
use App\DB\OrderList;
use App\DB\Product;
use App\DB\User;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\View\LineChart;
use App\View\PieChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\jDate;

class OrderController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  public function getAdd() {
    return view('admin.page.order.add-new');
  }

  public function getList() {
    return view('admin.page.order.list');
  }

  public function getListDay() {
    return view('admin.page.order.list-day');
  }

  public function getEdit() {
    return view('admin.page.order.edit');
  }

  public function getOrderList() {
    return view('admin.page.order.all-list');
  }

  public function getProductListEdit() {
    return view('admin.page.order.block.product-list-edit');
  }

  public function getReport() {
    return view('admin.page.order.report');
  }

  public function getOrderUnverified() {
    return view('admin.page.order.all-list', ['unver' => TRUE]);
  }


  public function postOrderList(Request $request) {
    return $this->_orderList($request);
  }

  public function postListDay(Request $request) {
    $records = OrderDay::select([
      '*',
      Order::$SELECT_TYPE_STR,
      Order::$SELECT_STS_STR,
      'when as when_str',
      'when as when_day',
      Order::$selectCJ,
    ]);
    $records->with('customer');
    $records->with('product');
    $records->with('order');
    return $this->tableEngine($records, $request->all());
  }

  public function postOrderUnverified(Request $request) {
    return $this->_orderList($request, 'unver');
  }

  public function postEditProductList(Request $request) {
    $this->validate($request, [
      'id' => "required"
    ]);

    $input = $request->all();

    OrderList::whereOid($input['id'])->delete();
    $sub = 0;
    foreach ($input['data']['order_item'] as $item) {
      $sub += ($item['total'] * $item['price']);
      OrderList::create([
        'pid' => (isset($item['pid'])) ? $item['pid'] : $item['id'],
        'oid' => $input['id'],
        'price' => $item['price'],
        'total' => $item['total']
      ]);
    }
    Order::find($input['id'])->update(['price' => $sub]);
    return response()->json(TRUE);
  }

  public function postGetEditData(Request $request) {
    $this->validate($request, ['id' => 'required']);
    $order = Order::
    with('sender_ac')
      ->with('visitor_ac')
      ->with('uid_ac')
      ->find($request->input('id'));
    $order = $order->toArray();
    if (!is_null($order['visitor'])) {
      $order['visitor'] = $order['visitor_ac'];
    }

    if (!is_null($order['sender'])) {
      $order['sender'] = $order['sender_ac'];
    }

    if (!is_null($order['uid'])) {
      $order['customer'] = $order['uid_ac'];
    }
    return response()->json($order);
  }

  public function postGetDayReportData(Request $request) {
    $input = $request->all();
    $jdate = (isset($input['date'])) ? $input['date'] : jDate::forge()
      ->format('Y/m/d');
    $date = Carbon::instance(jDate::dateTimeFromFormat('Y/m/d', $jdate));
    $export = [
      'dt' => [
        'total_order' => Order::date('created_at', $date)->count(),
        'order_paid' => Order::date('created_at', $date)->paid()->count(),
        'order_unpaid' => Order::date('created_at', $date)->unpaid()
          ->count(),
        'income' => Order::date('created_at', $date)->paid()->sum('price'),
      ],
      'date' => $jdate
    ];
    if (is_null($export['dt']['income'])) {
      $export['dt']['income'] = 0;
    }
    return response()->json($export);
  }

  public function postGetWeekReportData(Request $request) {
    $input = $request->all();
    $jdate = (isset($input['date'])) ? $input['date'] : jDate::forge()
      ->format('Y/m/d');
    $date = Carbon::instance(jDate::dateTimeFromFormat('Y/m/d', $jdate));
    $sub = Carbon::parse($date->toDateTimeString())->subDays(30);
    $export = [
      'dt' => [
        'total_order' => Order::date('created_at', [$sub, $date])->count(),
        'order_paid' => Order::date('created_at', [$sub, $date])
          ->paid()
          ->count(),
        'order_unpaid' => Order::date('created_at', [$sub, $date])
          ->unpaid()
          ->count(),
        'income' => Order::date('created_at', [$sub, $date])
          ->paid()
          ->sum('price'),
      ],
      'date' => $jdate
    ];
    if (is_null($export['dt']['income'])) {
      $export['dt']['income'] = 0;
    }
    return response()->json($export);
  }

  public function postGetMonthReportData(Request $request) {
    $input = $request->all();
    $jdate = (isset($input['date'])) ? $input['date'] : jDate::forge()
      ->format('Y/m/d');
    $date = Carbon::instance(jDate::dateTimeFromFormat('Y/m/d', $jdate));
    $sub = Carbon::parse($date->toDateTimeString())->subMonth(1);
    $export = [
      'dt' => [
        'total_order' => Order::date('created_at', [$sub, $date])->count(),
        'order_paid' => Order::date('created_at', [$sub, $date])->paid()
          ->count(),
        'order_unpaid' => Order::date('created_at', [$sub, $date])->unpaid()
          ->count(),
        'income' => Order::date('created_at', [$sub, $date])->paid()
          ->sum('price'),
      ],
      'date' => $jdate
    ];
    if (is_null($export['dt']['income'])) {
      $export['dt']['income'] = 0;
    }
    return response()->json($export);
  }

  public function postDayPieChart(Request $request) {
    $input = $request->all();
    if (!isset($input['order_paid'])) {
      $input['order_paid'] = 0;
    }
    if (!isset($input['order_unpaid'])) {
      $input['order_unpaid'] = 0;
    }
    $chart = PieChart::object([$input['order_paid'], $input['order_unpaid']], [
      'پرداخت شده',
      'پرداخت نشده'
    ], ['#607D8B', '#03A9F4']);
    return response()->json($chart);
  }

  public function postWeekLineChart(Request $request) {
    $input = $request->all();
    $jDate = $input['date'];
    $carbon = Carbon::instance(jDate::dateTimeFromFormat('Y/m/d', $jDate))
      ->subDays(7);
    $paid = Order::paid();
    $unpaid = Order::unpaid();
    $p = [];
    $u = [];
    $t = [];
    for ($i = 0; $i < 8; $i++) {
      $p[] = $paid->whereDate('created_at', '=', $carbon)->count();
      $u[] = $unpaid->whereDate('created_at', '=', $carbon)->count();
      $t[] = jDate::forge($carbon->format('Y/m/d'))->format('m/d (l)');
      $carbon->addDay();
    }
    $chart = LineChart::object(
      [
        $p,
        $u,
      ],
      $t,
      [
        'پرداختی ها',
        'پرداخت نشده ها'
      ]);
    return response()->json($chart);
  }


  public function postMonthLineChart(Request $request) {
    $input = $request->all();
    $jDate = $input['date'];
    $carbon = Carbon::instance(jDate::dateTimeFromFormat('Y/m/d', $jDate))
      ->subDays(30);
    $paid = Order::paid();
    $unpaid = Order::unpaid();
    $p = [];
    $u = [];
    $t = [];
    for ($i = 0; $i < 31; $i++) {
      $p[] = $paid->whereDate('created_at', '=', $carbon)->count();
      $u[] = $unpaid->whereDate('created_at', '=', $carbon)->count();
      $t[] = jDate::forge($carbon->format('Y/m/d'))->format('m/d (l)');
      $carbon->addDay();
    }
    $chart = LineChart::object(
      [
        $p,
        $u,
      ],
      $t,
      [
        'پرداختی ها',
        'پرداخت نشده ها'
      ]);
    return response()->json($chart);
  }

  protected function _orderList(Request $request, $p = NULL) {
    $records = Order::select([
      '*',
      Order::$SELECT_TYPE_STR,
      Order::$SELECT_TIME_STR,
      Order::$SELECT_DAY_STR,
      Order::$SELECT_STS_STR,
      Order::$selectCJ,
      Order::$selectUJ,
    ]);
    if ($p == 'unver') {
      $records->where('sts', -1);
    }
    $records->with('customer');
    $records->with('user');
    return $this->tableEngine($records, $request->all());
  }

  public function postGetOrderItems(Request $request) {
    $this->validate($request, ['id' => 'required']);
    $oitems = OrderList::where('oid', $request->input('id'))
      ->with('product_name')
      ->get();
    return response()->json($oitems);
  }

  public function postOrderPrices(Request $request){
    return response()->json(Product::GetPrc());
  }
  
  public function postAdd(Request $request) {
    $input = $request->all();
    $input['creator'] = Auth::user()->id;
    if (isset($input['customer']) && isset($input['customer']['id'])) {
      $input['uid'] = $input['customer']['id'];
    }

    if (isset($input['visitor']) && isset($input['visitor']['id'])) {
      $input['visitor'] = $input['visitor']['id'];
    }

    if (isset($input['sender']) && isset($input['sender']['id'])) {
      $input['sender'] = $input['sender']['id'];
    }


    if (isset($input['send_at'])) {
      $input['send_at'] = Carbon::instance(jDate::dateTimeFromFormat('Y/m/d', $input['send_at']));
      if (isset($input['send_at_time'])) {
        $carbon = Carbon::parse($input['send_at_time']);
        $input['send_at']->setTime($carbon->hour, $carbon->minute);
      }
    }

    $input['type'] = Order::$NORMAL_TYPE;
    $input['total_product'] = sizeof($input['order_item']);
    $input['sts'] = -1;
    $input['submit'] = -1;
    $input['price'] = $input['total'];
    $order = Order::create($input);
    foreach ($input['order_item'] as $item) {
      OrderList::create(
        [
          'pid' => $item['id'],
          'oid' => $order->id,
          'price' => $item['price'],
          'total' => $item['total']
        ]
      );
    }
    return response()->json(['result' => TRUE]);
  }


  public function postGetProduct(Request $request) {
    $input = $request->all();
    $record = Product::
    where('title', 'LIKE', '%' . $input['textSearch'] . '%')
      ->orWhere('code', 'LIKE', '%' . $input['textSearch'] . '%')
      ->select([
        'id',
        'price',
        DB::raw("CONCAT_WS(' ',title ,concat('(',code,')')) as value")
      ])
      ->get();
    return response()->json($record);
  }

  public function postGetCustomer(Request $request) {
    $input = $request->all();
    $record = DB::table('users')
      ->join('user_info', 'users.id', '=', 'user_info.uid')
      ->where('type', '>', 9)
      ->where(function ($query) use ($input) {
        $query->where('fname', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('lname', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('user_info.mobile', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('users.id', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('users.email', 'LIKE', '%' . $input['textSearch'] . '%');
      })
      ->select([
        'users.id',
        DB::raw("CONCAT_WS('' , users.fname,' ', lname , ' (' ,  user_info.mobile , ') ' ) as value")
      ])
      ->get();
    return response()->json($record);
  }

  public function postGetSender(Request $request) {
    $input = $request->all();
    $record = User::sender()
      ->where(function ($query) use ($input) {
        $query->where('fname', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('lname', 'LIKE', '%' . $input['textSearch'] . '%');
      })
      ->select([
        'id',
        DB::raw("CONCAT(fname,' ', lname) as value")
      ])
      ->get();
    return response()->json($record);
  }

  public function postGetVisitor(Request $request) {
    $input = $request->all();
    $record = User::visitor()
      ->where(function ($query) use ($input) {
        $query->where('fname', 'LIKE', '%' . $input['textSearch'] . '%')
          ->orWhere('lname', 'LIKE', '%' . $input['textSearch'] . '%');
      })
      ->select([
        'id',
        DB::raw("CONCAT(fname,' ', lname) as value")
      ])
      ->get();
    return response()->json($record);
  }

  public function postGetFlowers(Request $request) {
    $input = $request->all();
    $record = Cnt::flower()
      ->where('title', 'LIKE', '%' . $input['textSearch'] . '%')
      ->select(['id', 'title as value'])
      ->get();
    return response()->json($record);
  }


  public function postSetVisitor(Request $request) {
    $this->validate($request, ['id' => 'required']);
    $input = $request->all();
    Order::find($input['id'])->update(['visitor' => Auth::user()->id]);
    return response()->json(TRUE);
  }

  public function postSetSender(Request $request) {
    $this->validate($request, ['id' => 'required']);
    $input = $request->all();
    Order::find($input['id'])->update(['sender' => Auth::user()->id]);
    return response()->json(TRUE);
  }

  public function postSetSts(Request $request) {
    $this->validate($request, ['id' => 'required']);
    $input = $request->all();
    Order::find($input['id'])->update(['sts' => $input['sts']]);
    return response()->json(TRUE);

  }


  public function postCustomerSearch(Request $request) {
    $input = $request->all();

    $users = Customer::where('name', 'LIKE', '%' . $input['query'] . '%')
      ->select(['id', 'name as title'])
      ->get()
      ->toArray();
    return response()->json(['results' => $users]);
  }


  public function postGetData(Request $request) {
    $input = $request->all();
    return response()->json(Customer::find($input['customer']['id']));
  }


  public function postSubmit(Request $request) {
    $input = $request->all();

    foreach ($input['orders'] as $order) {
      $obj = [
        'type' => array_get($order, 'type', NULL),
        'time' => array_get($order, 'time', NULL),
        'week' => array_get($order, 'week', NULL),
        'sending' => array_get($order, 'sending', NULL),
        'first' => jDate::dateTimeFromFormat('Y/m/d', array_get($order, 'first', jDate::forge()
          ->format('Y/m/d'))),
        'w' => array_get($order, 'w', NULL),
        'sending_name' => array_get($order, 'sending_name', NULL),
        'sending_mobile' => array_get($order, 'sending_mobile', NULL),
        'sending_address' => array_get($order, 'sending_mobile', NULL),
        'prc' => array_get($order, 'prc', NULL),
        'total' => array_get($order, 'total', NULL),
        'pay_type' => array_get($order, 'pay_type', NULL),
        'price' => array_get($order, 'price', NULL),
        'bank' => array_get($order, 'bank', NULL),
        'cid' => array_get($input, 'customer.id', NULL),
        'uid' => Auth::user()->id,
        'no' => array_get($order, 'no', NULL),
        'sts' => array_get($order, 'sts', '-1'),
      ];
      if(isset($order['id'])){
        Order::find($order['id'])->update($obj);
      }else{
        Order::create($obj);
      }
    }

    return response()->json(['result' => TRUE]);
  }


  public function postGetPrc(Request $request){
    $input = $request->all();
    $orders = Order::whereCid($input['cid'])->get();
    return response()->json($orders);
  }

}
