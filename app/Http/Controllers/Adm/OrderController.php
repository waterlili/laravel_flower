<?php

namespace App\Http\Controllers\Adm;

use App\DB\FlowerVase;
use App\DB\OrderItem;
use Mail;
use App\DB\Cnt;
use App\Jobs\ChangeStatusOfOrders;
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

    public function getDailyGeneration()
    {
        return view('admin.page.order.dailyGeneration');
    }

    public function getDailyOrders()
    {
        return view('admin.page.order.dailyOrders');
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

    public function postDailyGeneration(Request $request)
    {
        $record = OrderItem::select([
            '*',
            OrderItem::$SELECT_SENT_AT,
            OrderItem::$SELECT_PERIOD,
            DB::Raw('count(*) as Day_count')

        ])->whereItemable_type('FlowerPacket')->with('flowerPacket')->groupBy(DB::Raw('DATE(sent_at)'), 'combination', 'period');
        //overwrite number of total
        $count = $record->get()->count();
        //print table out
        $input = $request->all();
        if (isset($input['exportPrint'])) {
            return $this->tablePrint($record, $input);
        }
        //print excel
        if (isset($input['excelExport'])) {
            return $this->tableExcel($record, $input);
        }
        //filter your table
        $this->tableFilter($record, $input, true);

        $export = $this->tableEngine($record, $request->all(), true);
        //add some attribute to exist query
        $export['total'] = $count;
        return $export;

    }

    public function postDailyOrders(Request $request)
    {
        $record = OrderItem::select([
            '*',
            OrderItem::$SELECT_SENT_AT,
            OrderItem::$SELECT_PERIOD,

        ])->with('order');
//        return $record;
//        $today = jdate()->format('date');
//        $record = OrderItem::all()->sortByDesc('sent_at');
//        $record->load('order');



        $export = $this->tableEngine($record, $request->all(), true);


        return $export;

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


    public function postGetFlowers(Request $request) {
        $input = $request->all();
        $record = Cnt::flower()
            ->where('title', 'LIKE', '%' . $input['textSearch'] . '%')
            ->select(['id', 'title as value'])
            ->get();
        return response()->json($record);
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
        $users = Customer::where(function ($q) use ($input) {
            $q->where('fname', 'LIKE', '%' . $input['query'] . '%')
                ->orWhere('lname', 'LIKE', '%' . $input['query'] . '%');
        })
            ->select(['id', DB::raw('CONCAT(fname , " " , lname) as title'), 'mobile', 'email', 'job_id', 'code'])
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

        $message1 = "وارد کردن فیلد تاریخ الزامی می باشد";
        //find packages that are set for special packet
        $orders = count($input['new_orders']);
        $packets_rand = array();

        for ($i = 0; $i < $orders; $i++) {
            //first of all diagnose first date isn't null
            if (!empty($input['new_orders'][$i]['first'])) {
                //get start date and save it database
                $started_at = $input['new_orders'][$i]['first'];
                $date = str_replace('/', '-', $started_at);
                $started_at = Carbon::createFromFormat('Y-m-d', $date);
                $last_date = '';
                //first of all submit order in orders
                $start_order = clone $started_at;
                if ($input['new_orders'][$i]['time'] == 1 || $input['new_orders'][$i]['time'] == 2)
                    $period = 1;
                if ($input['new_orders'][$i]['time'] == 3 || $input['new_orders'][$i]['time'] == 4)
                    $period = 2;
                //order type
                if (!empty($input['new_orders'][$i]['pck_type'])) {


                    if (!empty($input['new_orders'][$i]['w'])) {

                        $order = $this->submitOrder($input, $orders, $started_at)->getData();

                        if (empty($order->last_insert_id)) {
                            $message = "خطا در ثبت سفارش";
                            return response()->json(array('error' => false, 'msg' => $message), 422);
                        } else {
                            $id = $order->last_insert_id;
                        }
                        $month = (int)$input['new_orders'][$i]['w'];
                    } else
                        continue;
                    $week = $month * 4;
                    $pk_type = explode('|', $input['new_orders'][$i]['pck_type']);
                    $pk_id = $pk_type[0];
                    $packages = FlowerPacket::find($pk_id)->packages()->distinct()->get();


                    foreach ($packages as $package) {
                        $packets_rand[] = $package;
                    }
                    $packet = FlowerPacket::find((int)$pk_id);
                    $pkg_cnt = count($packets_rand);
                    $numbers = range(0, $pkg_cnt - 1);
                    shuffle($numbers);

                    if ($input['new_orders'][$i]['type'] == 2) {


                        $packages = FlowerPacket::find($pk_id)->packages()->get();
                        $packets_rand = $packages->toArray();
                        if ($packets_rand != null)
                            $rand_keys = array_rand($packets_rand, 1);
                        else
                            return response()->json(['result' => FALSE], 422);
                        if (isset($packets_rand[$rand_keys]['name']))
                            $rnd_pkt = $packets_rand[$rand_keys]['name'];

                        $orderItem = new OrderItem();
                        $orderItem->order_id = $id;
                        $orderItem->sts = 1;
                        $orderItem->count = 0;
                        $orderItem->period = $period;
                        $orderItem->combination = $rnd_pkt;
                        $orderItem->sent_at = $start_order;
                        $txt = explode('-', $rnd_pkt);
                        $orderItem->text = json_encode($txt);
                        $orderItem->orderItem($packet);
                        $orderItem->save();
                    } elseif ($pkg_cnt >= $week) {
                        shuffle($numbers);
                        for ($k = 0; $k < $week; $k++) {
                            $rand_keys = $numbers[$i];
                            $rnd_pkt = $packets_rand[$rand_keys]['name'];

                            $orderItem = new OrderItem();
                            $orderItem->order_id = $id;
                            $orderItem->sts = 1;
                            $orderItem->count = 0;
                            $orderItem->period = $period;
                            $orderItem->combination = $rnd_pkt;
                            $txt = explode('-', $rnd_pkt);
                            $orderItem->text = json_encode($txt);
                            $orderItem->orderItem($packet);

                            if ($k == 0) {
                                $send_at = $start_order;
                                $last_date = $send_at;
                                $orderItem->sent_at = $send_at;
//
                            } else {
                                $extra_date = 7;
                                $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                                $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                                $orderItem->sent_at = $next_time;
                                $last_date = $next_time;


                            }
                            $orderItem->save();

                        }
                    } elseif ($pkg_cnt <= $week) {
                        $packages = FlowerPacket::find($pk_id)->packages()->distinct()->get();
                        $packets_rand = $packages->toArray();
                        $exist_arr = array();
                        for ($j = 0; $j < $week; $j++) {
                            if ($pkg_cnt == 1) {


                                $rnd_pkt = $packets_rand[0]['name'];

                                $orderItem = new OrderItem();
                                $orderItem->order_id = $id;
                                $orderItem->sts = 1;
                                $orderItem->count = 0;
                                $orderItem->period = $period;
                                $orderItem->combination = $rnd_pkt;
                                $txt = explode('-', $rnd_pkt);
                                $orderItem->text = json_encode($txt);
                                $orderItem->orderItem($packet);

                                if ($j == 0) {
                                    $send_at = $start_order;
                                    $last_date = $send_at;
                                    $orderItem->sent_at = $send_at;

                                } else {
                                    $extra_date = 7;
                                    $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                                    $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                                    $orderItem->sent_at = $next_time;
                                    $last_date = $next_time;


                                }
                                $orderItem->save();
                            } else {

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

                                    //create suborder


                                    $orderItem = new OrderItem();
                                    $orderItem->order_id = $id;
                                    $orderItem->sts = 1;
                                    $orderItem->count = 0;
                                    $orderItem->period = $period;
                                    $orderItem->combination = $rnd_pkt;
                                    $txt = explode('-', $rnd_pkt);
                                    $orderItem->text = json_encode($txt);
                                    $orderItem->orderItem($packet);

                                    if ($j == 0) {
                                        $send_at = $start_order;
                                        $last_date = $send_at;
                                        $orderItem->sent_at = $send_at;

                                    } else {

                                        $extra_date = 7;
                                        $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                                        $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                                        $orderItem->sent_at = $next_time;
                                        $last_date = $next_time;


                                    }

                                    $orderItem->save();
                                    $exist_arr[] = $rand_keys;
                                    if (count($exist_arr) > 2 && ($pkg_cnt % 3 == 0)) {
                                        array_shift($exist_arr);
                                    } elseif (count($exist_arr) >= 2 && ($pkg_cnt % 2 == 0)) {
                                        array_shift($exist_arr);
                                    }
                                }
                            }


                        }
                    }
                } elseif (!empty($input['new_orders'][$i]['flw_type'])) {
                    if (!empty($input['new_orders'][$i]['w'])) {
                        //get start date and save it database
                        $started_at = $input['new_orders'][$i]['first'];
                        $date = str_replace('/', '-', $started_at);
                        $started_at = Carbon::createFromFormat('Y-m-d', $date);
                        //first of all submit order in orders
                        $order = $this->submitOrder($input, $orders, $started_at)->getData();
                        if (empty($order->last_insert_id)) {
                            $message = "خطا در ثبت سفارش";
                            return response()->json(array('error' => false, 'msg' => $message), 422);
                        } else {
                            $id = $order->last_insert_id;
                        }


                    } else
                        continue;

                    $fl_type = explode('|', $input['new_orders'][$i]['flw_type']);
                    $flw_id = $fl_type[0];
                    if ($input['new_orders'][$i]['type'] == 2) {
                        $packet = Flower::find((int)$flw_id);
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $id;
                        $orderItem->sts = 1;
                        $orderItem->count = $input['new_orders'][$i]['total'];
                        $orderItem->period = $period;
                        $orderItem->combination = null;
                        $orderItem->sent_at = $start_order;
                        $orderItem->text = null;
                        $orderItem->orderItem($packet);
                        $orderItem->save();
                    } else {
                        $month = (int)$input['new_orders'][$i]['w'];

                        $week = $month * 4;
                        for ($k = 0; $k < $week; $k++) {

                            $packet = Flower::find((int)$flw_id);
                            $orderItem = new OrderItem();
                            $orderItem->order_id = $id;
                            $orderItem->sts = 1;
                            $orderItem->count = $input['new_orders'][$i]['total'];
                            $orderItem->period = $period;
                            $orderItem->combination = null;
                            $orderItem->text = null;
                            $orderItem->orderItem($packet);
                            if ($k == 0) {
                                $send_at = $start_order;
                                $last_date = $send_at;
                                $orderItem->sent_at = $send_at;

                            } else {
                                $extra_date = 7;
                                $next_time = date('Y-m-d', strtotime($last_date . ' + ' . $extra_date . ' days'));
                                $next_time = Carbon::createFromFormat('Y-m-d', $next_time);
                                $orderItem->sent_at = $next_time;
                                $last_date = $next_time;


                            }
                            $orderItem->save();
                        }
                    }


                }

            } else {
                return response()->json(array('error' => false, 'msg' => $message1), 422);
            }


        }
        return response()->json(['result' => TRUE]);
    }




    public function submitOrder($input, $orders, $started_at)
    {


        $customer = $this->checkCustomer($input)->getData();

        if (!empty($customer->error) && $customer->error == false) {
            return response()->json(array('error' => false), 422);
        } else {
            $cid = $customer->customer_id;

            $mobile = $customer->customer_mobile;
            $order_id = Order::where([['cid', '=', $cid], ['type', '=', 1]])->first();
            $vase_id = null;
            $flag = 0;
            if (empty($order_id)) {
                // TODO selection of vase isn't clear
                $vase = FlowerVase::first();
                //for save in order take id
                $vase_id = $vase->id;
                $flag = 1;

            }
            if (empty($cid)) {
                return response()->json(array('error' => false), 422);
            } else {
                $type = "order";
                if (!empty($input['customer']['id'])) {
                    $number = Cnt::random_number($type);


                    for ($i = 0; $i <= $orders; $i++) {
//
                        if ($flag == 0 && !empty($input['new_orders'][$i]['flowerVase'])) {
                            $flag = 2;
                            $vase = FlowerVase::first();
                            //for save in order take id
                            $vase_id = $vase->id;
                            $vase_price = $vase->price;

                        } else {
                            $vase_price = 1;
                        }
                        $start = clone $started_at;

                        if (!empty($input['new_orders'][$i]['type']) && $input['new_orders'][$i]['type'] == 1) {
                            $t = $input['new_orders'][$i]['w'] * 4;
                            $end = $started_at->modify('+' . --$t . 'week');
                        } else {
                            $end = $start;
                        }

                        if (!empty($input['new_orders'][$i]['week'])) {
                            if (!empty($input['new_orders'][$i]['pck_type'])) {
                                //type2 is one means packet
                                $type2 = 1;
                            } else {
                                //type2 is one means flowers
                                $type2 = 2;
                            }
                            $amount = $this->postGetCaulateAmount($i, $input, $flag, $vase_price)->getData();
                            $obj = [
                                'cid' => $cid,
                                'number' => $number,
                                'vid' => $vase_id,
                                'amount' => $amount->amount,
                                'type' => array_get($input['new_orders'][$i], 'type', NULL),
                                'type2' => $type2,
                                'time_duration' => array_get($input['new_orders'][$i], 'time', NULL),
                                'daysOfWeek' => array_get($input['new_orders'][$i], 'week', NULL),
                                'sending' => array_get($input['new_orders'][$i], 'sending', NULL),
                                'month' => array_get($input['new_orders'][$i], 'w', NULL),
                                'sending_name' => array_get($input['new_orders'][$i], 'sending_name', NULL),
                                'sending_mobile' => array_get($input['new_orders'][$i], 'sending_mobile', NULL),
                                'sending_address' => array_get($input['new_orders'][$i], 'sending_mobile', NULL),
                                'started_at' => $start,
                                'expired_at' => $end,
//
                            ];
                            $id = Order::create($obj)->id;
                            if ($input['new_orders'][$i]['type'] == 1) {
                                $job = ((new ChangeStatusOfOrders($id))->delay($start->addWeeks(--$t)));
                                dispatch($job);
                            }
                            $ord_amount = $obj['amount'];
                            //each payment will do after create an object
                            app('App\Http\Controllers\Adm\PaymentController')->createPayment($id, $input, $i);
                            if (!empty($input['new_orders'][$i]['pay_type'])) {

                                switch ($input['new_orders'][$i]['pay_type']) {
                                    case 1:
                                        $this->postSendEmail($id, $ord_amount);
                                        break;
                                    case 3:

                                        $result = app('App\Http\Controllers\Adm\SmsController')->getSendMessage($id, $ord_amount, $mobile);
                                        $status = $result->getStatusCode();
                                        if ($status == 422) {
                                            return response()->json(array('error' => false), 422);

                                        } else {
                                            break;
                                        }
                                    default:
                                        return response()->json(array('success' => true, 'last_insert_id' => $id), 200);


                                }

                            } else {
                                return response()->json(array('success' => true, 'last_insert_id' => $id), 200);

                            }
                            return response()->json(array('success' => true, 'last_insert_id' => $id), 200);

                        } else {
                            continue;
                        }

                        return response()->json(array('success' => true, 'last_insert_id' => $id), 200);
                    }


                } else {
                    return response()->json(array('error' => false), 422);
                }
            }
        }


    }

    public function checkCustomer($input)
    {
        if (!empty($input['customer']['id'])) {
            $cid = $input['customer']['id'];
            $cMobile = $input['customer']['mobile'];
            return response()->json(array('success' => true, 'customer_id' => $cid, 'customer_mobile' => $cMobile), 200);

        } elseif (!empty($input['email'])) {
            $exist_customer = Customer::where('email', $input['email'])->first();
            if (empty($exist_customer)) {
//                $input['name'] = $input['fname'] . ' ' . $input['lname'];
                $input['sts'] = 1;
                $customer = Customer::create($input);
                $cid = $customer->id;
                $cMobile = $customer->mobile;
                return response()->json(array('success' => true, 'customer_id' => $cid, 'customer_mobile' => $cMobile), 200);

            }

        } else {
            return response()->json(array('error' => false), 422);

        }
    }

    public function postGetCaulateAmount($i, $input, $flag, $vase_price)
    {

        if ($i == -1) {
            $month = $input['new_orders'][$i]['w'];
            if (!empty($input['pck_type'])) {
                $pkt_id = $input['pck_type'];
                $price = FlowerPacket::where('id', $pkt_id)->pluck('price');

                if ($flag == 2 && !empty($vase_price)) {
                    $amount = ($price[0] * $month) + $vase_price;
                } else {

                    $amount = $price[0] * $month;
                }
                return response()->json(array('success' => true, 'amount' => $amount), 200);
            } elseif (empty($input['pck_type'])) {
                $flw_id = $input['flw_type'];
                $stalk = $input['total'];
                $price = Flower::where('id', $flw_id)->pluck('price');
                $prc_stalks = $price[0] * $stalk;
                if ($input['type'] == 1) {
                    $weeks = (int)$input['w'] * 4;
                    if ($flag == 2 && !empty($vase_price)) {
                        $total_price = ($prc_stalks * $weeks) + $vase_price;
                    } else {
                        $total_price = $prc_stalks * $weeks;
                    }
                } else
                    if ($flag == 2 && !empty($vase_price)) {
                        $total_price = $prc_stalks + $vase_price;
                    } else {
                        $total_price = $prc_stalks;
                    }
                return response()->json(array('success' => true, 'amount' => $total_price), 200);
            }
        }
        if (!empty($input['new_orders'][$i]['pck_type'])) {
            $pkt_id = $input['new_orders'][$i]['pck_type'];
            $month = $input['new_orders'][$i]['w'];
            $price = FlowerPacket::where('id', $pkt_id)->pluck('price');
            if ($flag == 2 && !empty($vase_price)) {
                $amount = ($price[0] * $month) + $vase_price;
            } else {

                $amount = ($price[0] * $month);
            }
            return response()->json(array('success' => true, 'amount' => $amount), 200);
        } elseif (empty($input['new_orders'][$i]['pck_type'])) {
            $fl_type = explode('|', $input['new_orders'][$i]['flw_type']);
            $flw_id = $fl_type[0];
            $flw_id = $flw_id;
            $stalk = $input['new_orders'][$i]['total'];
            $month = $input['new_orders'][$i]['w'];
            $price = Flower::where('id', $flw_id)->pluck('price');
            $prc_stalks = $price[0] * $stalk;
            if ($input['new_orders'][$i]['type'] == 1) {
                $weeks = (int)$input['new_orders'][$i]['w'] * 4;
                if ($flag == 2 && !empty($vase_price)) {
                    $total_price = ($prc_stalks * $weeks) + $vase_price;
                } else {
                    $total_price = $prc_stalks * $weeks;
                }
            } else
                if ($flag == 2 && !empty($vase_price)) {
                    $total_price = $prc_stalks + $vase_price;
                } else {
                    $total_price = $prc_stalks;
                }

            return response()->json(array('success' => true, 'amount' => $total_price), 200);
        }
    }

    public function postGetPrc(Request $request)
    {

        $input = $request->all();
        $orders = Order::whereCid($input['cid'])->select(['*', 'daysOfWeek as week_str', 'month as month_str', 'started_at as first_date'])->orderBy('id', 'desc')->get();
        $orders->load('orderItems', 'orderPayment');

        $date = array();
        foreach ($orders as $order) {
            $relData = $order->getRelations();
            $day = $order->week_str;

            if ($order->type == 1 && $relData['orderItems'][0]['itemable_type'] == 'Flower') {

                $flower_info = $relData['orderItems']->where('itemable_type', 'Flower');
                $flower = $relData['orderItems']->where('itemable_type', 'Flower')->load('flower');
                foreach ($flower_info as $flower_data) {
                    $date_sent = explode(' ', $flower_data->sent_at);
                    $flower_data->setAttribute('day', $day);
                    $flower_data->setAttribute('sent', $date_sent[0]);
                    $today = jDate::forge()->format('Y-m-d');
                    $flower_data->setAttribute('current', $today);
                }
                $order->setAttribute('flowerItem', $flower[0]);

            } else if ($order->type == 1 && $relData['orderItems'][0]['itemable_type'] == 'FlowerPacket') {
                $packet_detail = $relData['orderItems']->where('itemable_type', 'FlowerPacket')->load('flowerPacket');
                $flower_packet = $relData['orderItems']->where('itemable_type', 'FlowerPacket');
                foreach ($flower_packet as $packet) {
                    $date_sent = explode(' ', $packet->sent_at);
                    $packet->setAttribute('day', $day);
                    $packet->setAttribute('sent', $date_sent[0]);
                    $today = jDate::forge()->format('Y-m-d');
                    $packet->setAttribute('current', $today);
                }
                $order->setAttribute('packetItem', $packet_detail[0]);
            } else if ($order->type == 2 && $relData['orderItems'][0]['itemable_type'] == 'Flower') {
                $relData['orderItems']->where('itemable_type', 'Flower')->load('flower');
            } else if ($order->type == 2 && $relData['orderItems'][0]['itemable_type'] == 'FlowerPacket') {
                $relData['orderItems']->where('itemable_type', 'FlowerPacket')->load('flowerPacket');
            }


        }
        $order_packet = Order::where([['cid', '=', $input['cid']], ['type', '=', 1]])->first();
        if (empty($order_packet))
            $flag = 1;
        else
            $flag = 0;


        return response()->json(['orders' => $orders, 'flag' => $flag], 200);

    }

    public function postGetPacketPrc(Request $request)
    {
        $pck_id = $request->pck_type;
        $packet = FlowerPacket::select(['id', 'price'])->where('id', $pck_id)->get()->toArray();

        return response()->json($packet);
    }

    public function postSendEmail($id, $ord_amount)
    {
        $data1 =array( 'data'=> array(
            'orderId' => $id,
            'Amount' => $ord_amount
        ));
        Mail::send('emails.send', $data1, function ($message) {
            $message->from('info@ghoncheflowers.ir', 'بونیتا');
            $message->to('nw.tahmasebi@gmail.com');
        });

        return response()->json(['message' => 'Request completed']);
    }



}
