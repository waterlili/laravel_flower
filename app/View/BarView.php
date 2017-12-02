<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27/11/2016
 * Time: 10:22 PM
 */

namespace App\View;


class BarView {

  public static function create($key, $value, $color) {
    return view()
      ->make('MD.viewer.bar', [
        $key,
        $value,
        $color
      ], array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }
}