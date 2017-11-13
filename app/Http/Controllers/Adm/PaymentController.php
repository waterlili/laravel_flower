<?php

namespace App\Http\Controllers\Adm;

use App\DB\OrderPayment;
use Request;
use App\DB\Order;
use SoapClient;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    public function createPayment($id, $input, $i)
    {
        $order_payment = new OrderPayment();
        if (empty($input['new_orders'][$i]['pay_type']) || $input['new_orders'][$i]['pay_type'] == 5) {

            $order_payment->sts = Null;
            $type = null;
        } else {
            $type = $input['new_orders'][$i]['pay_type'];
        }

        $order_payment->oid = $id;
        $order_payment->type = $type;
        $order_payment->save();
        return $type;
    }

    public function getZarinpal($query)
    {
        $qu = http_build_query(array($query));
        $arr=explode("&",$query);
        $OrderId=explode("=",$arr[0]);
        $Amount=explode("=",$arr[1]);
        $MerchantID = 'cb4e1e9c-84e1-11e6-bd64-000c295eb8fc'; //Required
        $Description = 'just due'; // Required
        $Info = ['expire_In' => 86400];
        $‫‪AdditionalData‬‬ = json_encode($Info);
        $CallbackURL = 'http://185.173.106.234/payment/'.$qu.'/zarinpal-response'; // Required



        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->‫‪PaymentRequestWithExtra‬‬(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount[1],
                'orderId' => $OrderId[1],
                'Description' => $Description,
                '‫‪AdditionalData‬‬' => $‫‪AdditionalData‬‬,
                'CallbackURL' => $CallbackURL,
            ]
        );

//dd('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
//Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }
    public function getZarinpalResponse($query){

        $Authority = $_GET['Authority'];
        $arr=explode("&",$query);
        $OrderId=explode("=",$arr[0]);
        $Amount=explode("=",$arr[1]);

        $data = array('MerchantID' => 'cb4e1e9c-84e1-11e6-bd64-000c295eb8fc', 'Authority' => $Authority, 'Amount' => $Amount[1]);
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                if (!empty($OrderId[2])) {
                    $order = Order::orderBy('created_at', 'DESC')->where('id', $OrderId[2])->first();
                    if (!empty($order))
                        OrderPayment::where('oid', $order->id)->update(['sts' => 1, 'refID' => $result['RefID']]);
                }
                $refID = $result['RefID'];
                return view('admin/page/payment/paymentstatus', compact('refID'));
            } else {
                $status = $result['Status'];
                return view('admin/page/payment/paymentstatus', compact('status'));


            }
        }
    }
}
