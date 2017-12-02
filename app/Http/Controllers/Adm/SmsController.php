<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DB\KavenegarApi;

class SmsController extends Controller
{
    public function getSendMessage($id, $ord_amount, $mobile)
    {

        $data = array(
            'orderId' => $id,
            'Amount' => $ord_amount
        );
        $sender = "10004346";
        $receptor = $mobile;
        $query = http_build_query(array('aParam' => $data));
        $message = "لینک پرداخت بونیتا:)
                    http://185.173.106.234/payment/$query/zarinpal";
        $api = new KavenegarApi("707041326F734C485A346D5165672F616C656C4471413D3D");
        $res = $api->Send($sender, $receptor, $message);
        $type = gettype($res);
        if ($type == 'array')
            $status = $res[0]->status;
        else
            $code = $res->getCode();



        $message1 = "خطا در ارسال";
        $message2 = "در حال ارسال";

        if (!empty($code) && $code != 200) {
            return response()->json(['message', $message1], 422);
        } else if (!empty($status) && $status == 1) {
            return response()->json(['message', $message2], 200);

        }


    }

}
