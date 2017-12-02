<?php

namespace App\Jobs;

use App\DB\Cnt;
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
        $cnt_date = new Cnt();
        $cnv_date = $cnt_date->convert($now_con);
        if ($exp <= $cnv_date) {
            $order->update(array('sts' => 0));

        }

    }


}
