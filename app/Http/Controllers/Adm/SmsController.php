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
        $sender = "100065995";
        $receptor = $mobile;
        $query = http_build_query(array('aParam' => $data));
        $message = "لینک پرداخت بونیتا:)
                    http://185.173.106.234/payment/$query/zarinpal";
        $api = new KavenegarApi("6756677159634973344D706951593961467647486E673D3D");
        $api->Send($sender, $receptor, $message);

        return redirect()->back()->with('message', 'Message has been sent successfully');
    }

}
