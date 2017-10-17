<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $MerchantID = 'cb4e1e9c-84e1-11e6-bd64-000c295eb8fc'; //Required
        $Amount = 1000; //Amount will be based on Toman - Required
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = 'UserEmail@Mail.Com'; // Optional
        $Mobile = '09123456789'; // Optional
        $CallbackURL = 'http://www.yoursoteaddress.ir/verify.php'; // Required


        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

//Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }
}
