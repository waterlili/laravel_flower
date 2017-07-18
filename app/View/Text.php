<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 11:22 AM
 */

namespace App\View;


class Text extends InputObject {
  /**
   * Text constructor.
   */
  public function __construct($ngModel, $label) {
    parent::__construct($ngModel, $label);
    $this->type = 'text';
    $this->name = join('', explode('.', $ngModel));
  }

  public static function create($ngModel, $label) {
    $slf = new static($ngModel, $label);
    return $slf;
  }

  public function dateInput() {
    $this->setInpAttr('ng-jalaali-flat-datepicker');
    $this->setInpAttr("datepicker-config={dateFormat:'jYYYY/jMM/jDD',allowFuture:true}");
    return $this;
  }
}