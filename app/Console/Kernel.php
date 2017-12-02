<?php

namespace App\Console;

use App\DB\Order;
use App\DB\Cnt;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $orders = Order::where('sts', 1)->get();
            $now = Carbon::parse(Carbon::now())->format('Y,m,d');
            $now_con = \jDateTime::strftime('Y,m,d', strtotime($now));
            $cnt_date = new Cnt();
            $cnv_date = $cnt_date->convert($now_con);
            foreach ($orders as $order) {
                $exp = Carbon::parse($order['expired_at'])->format('Y,m,d');
                $count = $order['sent_count'];
                if ($exp <= $cnv_date) {
                    $order->update(array('sent_count' => ++$count));

                }

            }
        })->weekly()->fridays()->at('23:50');
    }

}
