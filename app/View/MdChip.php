<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 01:10 PM
 */

namespace App\View;


class MdChip extends InputObjectAc {
  /**
   * Select constructor.
   * @param $items
   */
  public function __construct($ngModel, $ngOption, $link, $label) {
    parent::__construct($ngModel, $ngOption, $link, $label);
    $this->name = join('', explode('.', $ngModel));
  }

  public static function create($ngModel, $ngOption, $link, $label) {
    $slf = new static($ngModel, $ngOption, $link, $label);
    return $slf;
  }
  
  public function export() {
    return view()
      ->make('MD.input.chipAc', parent::export(), array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }

}