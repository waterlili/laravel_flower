<?php

namespace App\Providers;


use App\DB\Order;
use App\DB\OrderDay;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    $this->orderDay();
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {

  }


  protected function orderDay() {
    Order::updated(function ($order) {
      OrderDay::whereOid($order->id)->delete();
      $this->_orderDay($order);
    });
    Order::created(function ($order) {
      $this->_orderDay($order);
    });
  }

  protected function _orderDay($order) {
    if ($order->type == 1) {
      for ($i = 0; $i < $order->w * 4; $i++) {
        OrderDay::create(
          [
            'oid' => $order->id,
            'cid' => $order->cid,
            'when' => Carbon::instance($order->first)->addWeek($i),
            'count' => $i+1,
            'w' => $order->w,
            'sts' => $order->sts,
            'type' => 1,
            'prc' => $order->prc,
            'total' => $order->total
          ]
        );
      }
    }
    else {
      OrderDay::create(
        [
          'oid' => $order->id,
          'cid' => $order->cid,
          'when' => $order->first,
          'w' => $order->w,
          'sts' => $order->sts,
          'type' => 2,
          'prc' => $order->prc,
          'total' => $order->total
        ]
      );
    }
  }
}
