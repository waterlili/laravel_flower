<?php

namespace App\Http\Controllers\Adm;

use Mail;
use App\DB\Cnt;
use App\DB\Customer;
use App\DB\FlowerPacket;
use App\DB\Flower;
use App\DB\FlowerPacketType;
use App\DB\Order;
use App\DB\OrderPayment;
use App\DB\OrderDay;
use App\DB\OrderFlower;
use App\DB\OrderList;
use App\DB\OrderPacket;
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

    public function getListDay()
    {
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

    public function postListDay(Request $request)
    {
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

    public function postOrderPrices(Request $request)
    {
        return response()->json(Order::GetPrc());
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


    public function postCustomerSearch(Request $request)
    {

        $input = $request->all();

        $users = Customer::where('name', 'LIKE', '%' . $input['query'] . '%')
            ->select(['id', 'name as title'])
            ->get()
            ->toArray();
        return response()->json(['results' => $users]);
    }


    public function postGetData(Request $request)
    {
        $input = $request->all();
        return response()->json(Customer::find($input['customer']['id']));
    }


    public function postSubmit(Request $request)
    {

        $input = $request->all();
        //find packages that are set for special packet
        $orders = count($input['orders']) - 1;
        $packets_rand = array();
        for ($i = 0; $i <= $orders; $i++) {


            if (!empty($input['orders'][$i]['pck_type'])) {
                if (!empty($input['orders'][$i]['w'])) {
                    //first of all submit order in orders
                    $order = $this->submitOrder($input, $orders)->getData();
                    $id = $order->last_insert_id;
                    $month = (int)$input['orders'][$i]['w'];
                } else
                    continue;
                $week = $month * 4;
                $packages = FlowerPacket::find($input['orders'][$i]['pck_type'])->packages()->distinct()->get();
                foreach ($packages as $package) {
                    $packets_rand[] = $package;
                }
                $pkg_cnt = count($packets_rand);
                $numbers = range(0, $pkg_cnt - 1);
                shuffle($numbers);
                $started_at = $input['orders'][$i]['first'];
                $last_date = '';

                if ($input['orders'][$i]['type'] == 2) {
                    $packages = FlowerPacket::find($input['orders'][$i]['pck_type'])->packages()->get();
                    $packets_rand = $packages->toArray();
                    if ($packets_rand != null)
                        $rand_keys = array_rand($packets_rand, 1);
                    else
                        return response()->json(['result' => FALSE], 422);
                    if (isset($packets_rand[$rand_keys]['name']))
                        $rnd_pkt = $packets_rand[$rand_keys]['name'];
                    $pkt_order = new OrderPacket();
                    $pkt_order->order_id = $id;
                    $pkt_order->packet_id = (int)$input['orders'][$i]['pck_type'];
                    $pkt_order->combination = $rnd_pkt;
                    $pkt_order->type = (int)$input['orders'][$i]['type'];
                    $date = str_replace('/', '-', $started_at);
                    $send_at = Carbon::createFromFormat('Y-m-d', $date);
                    $pkt_order->send_at = $send_at;
                    $pkt_order->save();
                } elseif ($pkg_cnt >= $week) {

                    shuffle($numbers);
                    for ($k = 0; $k <= $week; $k++) {
                        $rand_keys = $numbers[$i];
                        $rnd_pkt = $packets_rand[$rand_keys]['name'];
                        $pkt_order = new OrderPacket();
                        $pkt_order->order_id = $id;
                        $pkt_order->packet_id = (int)$input['orders'][$i]['pck_type'];
                        $pkt_order->combination = $rnd_pkt;
                        $pkt_order->type = (int)$input['orders'][$i]['type'];
                        if ($k == 0) {
                            $date = str_replace('/', '-', $started_at);
                            $send_at = Carbon::createFromFormat('Y-m-d', $date);
                            $last_date = $send_at;
                            $pkt_order->send_at = $send_at;
//
                        } else {
                            $extra_date = 7;
                            $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                            $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                            $pkt_order->send_at = $next_time;
                            $last_date = $next_time;


                        }
                        $pkt_order->save();

                    }
                } elseif ($pkg_cnt <= $week) {

                    $packages = FlowerPacket::find($input['orders'][$i]['pck_type'])->packages()->get();
                    $packets_rand = $packages->toArray();

                    $exist_arr = array();
//                        shuffle($numbers);
                    for ($j = 0; $j < $week; $j++) {
                        if ($packets_rand != null) {

                            $rand_keys = array_rand($packets_rand, 1);
                        } else {
                            DB::table('orders')->latest()->delete();
                            return response()->json(['result' => FALSE], 422);
                        }
                        if (!empty($exist_arr) && in_array($rand_keys, $exist_arr)) {
                            $j--;
                            continue;
                        } else {
                            if (isset($packets_rand[$rand_keys]['name']))
                                $rnd_pkt = $packets_rand[$rand_keys]['name'];

                            $pkt_order = new OrderPacket();
                            $pkt_order->order_id = $id;
                            $pkt_order->packet_id = (int)$input['orders'][$i]['pck_type'];
                            $pkt_order->combination = $rnd_pkt;
                            $pkt_order->type = (int)$input['orders'][$i]['type'];
                            if ($j == 0) {
                                $date = str_replace('/', '-', $started_at);
                                $send_at = Carbon::createFromFormat('Y-m-d', $date);
                                $last_date = $send_at;
                                $pkt_order->send_at = $send_at;
//
                            } else {
                                $extra_date = 7;
                                $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                                $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                                $pkt_order->send_at = $next_time;
                                $last_date = $next_time;


                            }
                            $pkt_order->save();
                            $exist_arr[] = $rand_keys;
                            if (count($exist_arr) > 2 && ($pkg_cnt % 3 == 0)) {
                                array_shift($exist_arr);
                            } elseif (count($exist_arr) >= 2 && ($pkg_cnt % 2 == 0)) {
                                array_shift($exist_arr);
                            }
                        }


                    }
                }
            } elseif (!empty($input['orders'][$i]['flw_type'])) {
                if (!empty($input['orders'][$i]['w'])) {
                    //first of all submit order in orders
                    $order = $this->submitOrder($input, $orders)->getData();
                    $id = $order->last_insert_id;
                    $month = (int)$input['orders'][$i]['w'];
                } else
                    continue;
                $week = $month * 4;
                if ($input['orders'][$i]['type'] == 1) {
                    $flower = Flower::find($input['orders'][$i]['flw_type'])->distinct()->get();
                    $started_at = $input['orders'][$i]['first'];
                    $last_date = '';
                    for ($j = 0; $j < $week; $j++) {
                        $flw_order = new OrderFlower();
                        $flw_order->order_id = $id;
                        $flw_order->flower_id = (int)$input['orders'][$i]['flw_type'];
                        $flw_order->stalk_counter = $input['orders'][$i]['total'];
                        $flw_order->type = (int)$input['orders'][$i]['type'];

                        if ($j == 0) {
                            $date = str_replace('/', '-', $started_at);
                            $send_at = Carbon::createFromFormat('Y-m-d', $date);
                            $last_date = $send_at;
                            $flw_order->send_at = $send_at;
//
                        } else {
                            $extra_date = 7;
                            $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                            $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                            $flw_order->send_at = $next_time;
                            $last_date = $next_time;


                        }
                        $flw_order->save();

                    }

                } else {
                    $flw_order = new OrderFlower();
                    $flw_order->order_id = $id;
                    $flw_order->flower_id = (int)$input['orders'][$i]['flw_type'];
                    $flw_order->stalk_counter = $input['orders'][$i]['total'];
                    $flw_order->type = (int)$input['orders'][$i]['type'];
                    $date = str_replace('/', '-', $input['orders'][$i]['first']);
                    $send_at = Carbon::createFromFormat('Y-m-d', $date);
                    $flw_order->send_at = $send_at;
                    $flw_order->save();
                }


            }


        }
        return response()->json(['result' => TRUE]);
    }

    public function submitOrder($input, $orders)
    {

        $customer = $this->checkCustomer($input)->getData();
        $cid = $customer->customer_id;
        if (empty($cid)) {
            return response()->json(array('error' => false), 422);
        } else {
            if (!empty($input['customer']['id'])) {
                for ($i = 0; $i <= $orders; $i++) {
                    if (!empty($input['orders'][$i]['week'])) {
                        $amount = $this->postGetCaulateAmount($i, $input)->getData();
                        $obj = [
                            'cid' => $cid,
                            'amount' => $amount->amount,
                            'type' => array_get($input['orders'][$i], 'type', NULL),
                            'time' => array_get($input['orders'][$i], 'time', NULL),
                            'daysOfWeek' => array_get($input['orders'][$i], 'week', NULL),
                            'sending' => array_get($input['orders'][$i], 'sending', NULL),
                            'month' => array_get($input['orders'][$i], 'w', NULL),
                            'sending_name' => array_get($input['orders'][$i], 'sending_name', NULL),
                            'sending_mobile' => array_get($input['orders'][$i], 'sending_mobile', NULL),
                            'sending_address' => array_get($input['orders'][$i], 'sending_mobile', NULL),
//
                        ];
                        $id = Order::create($obj)->id;
                        return response()->json(array('success' => true, 'last_insert_id' => $id), 200);
                    } else {
                        continue;
                    }


                }
            } else {
                return response()->json(array('error' => false), 422);
            }
        }

    }

    public function checkCustomer($input)
    {
        if (!empty($input['customer']['id'])) {
            $cid = $input['customer']['id'];
            return response()->json(array('success' => true, 'customer_id' => $cid), 200);

        } elseif (!empty($input['email'])) {
            $exist_customer = Customer::where('email', $input['email'])->first();
            if (empty($exist_customer)) {
                $input['name'] = $input['fname'] . ' ' . $input['lname'];
                $input['sts'] = 1;
                $cid = Customer::create($input)->id;
                return response()->json(array('success' => true, 'customer_id' => $cid), 200);

            }

        } else {
            return response()->json(array('error' => false), 422);

        }
    }

    public function postGetCaulateAmount($i, $input)
    {
        if (!empty($input['orders'][$i]['pck_type'])) {
            $pkt_id = $input['orders'][$i]['pck_type'];
            $price = FlowerPacket::where('id', $pkt_id)->pluck('price');
            if ($input['orders'][$i]['type'] == 1)
                $count = (int)$input['orders'][$i]['w'] * 4;
            else
                $count = 1;
            $amount = $price[0] * $count;
            return response()->json(array('success' => true, 'amount' => $amount), 200);
        } else {
            $flw_id = $input['orders'][$i]['flw_type'];
            $stalk = $input['orders'][$i]['total'];
            $price = Flower::where('id', $flw_id)->pluck('price');
            $prc_stalks = $price[0] * $stalk;
            if ($input['orders'][$i]['type'] == 1) {
                $weeks = (int)$input['orders'][$i]['w'] * 4;
                $total_price = $prc_stalks * $weeks;
            } else
                $total_price = $prc_stalks;

            return response()->json(array('success' => true, 'amount' => $total_price), 200);
        }
    }

    public function postGetPrc(Request $request)
    {
        $input = $request->all();
        $orders = Order::whereCid($input['cid'])->get();
        return response()->json($orders);
    }

    public function postGetPacketPrc(Request $request)
    {
        $pck_id = $request->pck_type;
        $packet = FlowerPacket::select(['id', 'price'])->where('id', $pck_id)->get()->toArray();

        return response()->json($packet);
    }

    public function postSendEmail(Request $request)
    {
        $input = $request->all();
        $cid = $input['customer']['id'];
        $od_count = Order::where('cid', $cid)->get()->count();
            
        for ($i = 0; $i < $od_count; $i++) {
            if (!empty($input['orders'][$i]['id'])) {
                $oid = $input['orders'][$i]['id'];
                break;
             }
        }
            if(empty($oid)){

                $last_ord = Order::orderBy('created_at', 'desc')->first();
                if($last_ord)
                  $oid = $last_ord['id'] + 1;
                else{
                  $ord_new = new Order();
                   $oid = $ord_new->id;
                }
              
            }
        $title = $request->input('title');
        $message = $request->input('content');
        $data1 =array( 'data'=> array(
            'orderId' => $oid,
            'Amount' => 100
        ));

        Mail::send('emails.send', $data1, function ($message) {
            $message->from('nw.tahmasebi@gmail.com', 'Scotch.IO');
            $message->to('nw.tahmasebi@gmail.com');
        });

        return response()->json(['message' => 'Request completed']);
    }

}
