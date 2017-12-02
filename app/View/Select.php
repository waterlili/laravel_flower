<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 01:10 PM
 */

namespace App\View;


class Select extends InputObject {
  public $items;

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
  
}