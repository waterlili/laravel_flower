<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 01:10 PM
 */

namespace App\View;


class Radio extends InputObject {
  public $items, $fset;

  /**
   * Select constructor.
   * @param $items
   */
  public function __construct($ngModel, $label, $items) {
    parent::__construct($ngModel, $label);
    $this->items = $items;
    $this->name = join('', explode('.', $ngModel));
  }

  public static function create($ngModel, $label, $items) {
    $slf = new static($ngModel, $label, $items);
    return $slf;
  }


  public function export() {
    return view()
      ->make('MD.input.radio', parent::export(), array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }

  /**
   * @return mixed
   */
  public function getFset() {
    return $this->fset;
  }

  /**
   * @param mixed $fset
   */
  public function setFset($fset) {
    $this->fset = $fset;
    return $this;
  }


}