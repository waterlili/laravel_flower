<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use SoapClient;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function getZarinpal()
    {

        $MerchantID = 'cb4e1e9c-84e1-11e6-bd64-000c295eb8fc'; //Required
        $Amount = 100; //Amount will be based on Toman - Required
        $Order_id = $_GET['orderId'];
        $Description = 'توضیحات تراکنش تستی'; // Required
        $CallbackURL = 'http://185.173.106.234/payment/zarinpal-response'; // Required


        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'CallbackURL' => $CallbackURL,
            ]
        );
        dd($Order_id);
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
   public function getZarinpalResponse(){

         $Authority = $_GET['Authority'];
	 $data = array('MerchantID' => 'cb4e1e9c-84e1-11e6-bd64-000c295eb8fc', 'Authority' => $Authority, 'Amount' => 100);
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
	 echo 'Transation success. RefID:' . $result['RefID'];
	 } else {
	 echo 'Transation failed. Status:' . $result['Status'];
	 }
	 }

   }
}
