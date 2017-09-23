<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/11/2016
 * Time: 01:11 PM
 */

namespace App\View;


/**
 * @property  items
 */
class MD extends InputObject {


  public static function init($self , $ngModel, $label) {
    $self->type = 'text';
    $self->name = join('', explode('.', $ngModel));
    $self->ngModel = $ngModel;
    $self->label = $label;
    $self->ngMessage = [];
    $self->inpAttr = [];
    $self->autoMessage = TRUE;
    $self->required = FALSE;
    return $self;
  }

  public function form($form = NULL) {
    $this->formName = (is_null($form)) ? 'Form' : $form;
    return $this;
  }
}