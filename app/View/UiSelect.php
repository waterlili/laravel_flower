<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 11:22 AM
 */

namespace App\View;


class UiSelect extends InputObject {
  public $itemValue, $object;

  /**
   * Text constructor.
   */
  public function __construct($ngModel, $label) {
    parent::__construct($ngModel, $label);
    $this->name = join('', explode('.', $ngModel));
  }

  public static function create($ngModel, $label, $object, $itemVaLUE) {
    $slf = new static($ngModel, $label);
    $slf->setItemValue($itemVaLUE);
    $slf->object = $object;
    return $slf;
  }

  /**
   * @return mixed
   */
  public function getItemValue() {
    return $this->itemValue;
  }

  /**
   * @param mixed $itemValue
   */
  public function setItemValue($itemValue) {
    $this->itemValue = $itemValue;
  }


}