<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27/11/2016
 * Time: 10:41 PM
 */

namespace App\View;


class BarChart {
  public static function create($ngModel, $w, $h) {
    return view()
      ->make('MD.chart.barChart', [
        'ngMode' => $ngModel,
        'w' => $w,
        'h' => $h
      ], array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }
}