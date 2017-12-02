<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 01:10 PM
 */

namespace App\View;


class Checkbox extends InputObject {
  public $has_border;

  /**
   * Select constructor.
   * @param $items
   */
  public function __construct($ngModel, $label) {
    parent::__construct($ngModel, $label);
    $this->name = join('', explode('.', $ngModel));
  }

  public static function create($ngModel, $label) {
    $slf = new static($ngModel, $label);
    return $slf;
  }

  /**
   * @return mixed
   */
  public function getHasBorder() {
    return $this->has_border;
  }

  /**
   * @param mixed $has_border
   */
  public function hasBorder() {
    $this->has_border = TRUE;
    return $this;
  }


  public function export() {
    return view()
      ->make('MD.input.checkbox', parent::export(), array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }
}