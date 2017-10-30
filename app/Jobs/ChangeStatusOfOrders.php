<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\DB\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeStatusOfOrders extends Job implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    private $order_id;

    public function __construct($id)
    {
        $this->order_id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $order = Order::where('id', $this->order_id)->first();
        $now = Carbon::parse(Carbon::now())->format('Y,m,d');
        $exp = Carbon::parse($order['expired_at'])->format('Y,m,d');
        $now_con = \jDateTime::strftime('Y,m,d', strtotime($now));
        $cnv_date = $this->convert($now_con);
        if ($exp <= $cnv_date) {
            $order->update(array('sts' => 0));

        }

    }

    public function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
}
