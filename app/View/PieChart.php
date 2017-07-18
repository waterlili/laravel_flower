<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27/11/2016
 * Time: 10:41 PM
 */

namespace App\View;


class PieChart {
  public static function create($ngModel, $w, $h, $link) {
    return view()
      ->make('MD.chart.barChart', [
        'ngMode' => $ngModel,
        'w' => $w,
        'h' => $h,
        'type' => 'pie',
        'link' => $link
      ], array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }


  public static function object($data, $labels, $color = NULL) {
    return ['data' => $data, 'labels' => $labels, 'colors' => $color];
  }
}