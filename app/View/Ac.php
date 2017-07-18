<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 11:16 PM
 */

namespace App\View;


class Ac extends InputObjectAc {


  /**
   * Select constructor.
   * @param $items
   */
  public function __construct($ngModel, $ngOpt, $link, $label) {
    parent::__construct($ngModel, $ngOpt, $link, $label);
    $this->name = join('', explode('.', $ngModel));
  }

  public static function create($ngModel, $ngOpt, $link, $label) {
    $slf = new static($ngModel, $ngOpt, $link, $label);
    return $slf;
  }


  public function export() {
    return view()
      ->make('MD.input.autocomplete', parent::export(), array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
  }

}