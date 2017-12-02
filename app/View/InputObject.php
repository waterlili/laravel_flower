<?php
/**
 * Created by PhpStorm.
 * User: AhmadReza
 * Date: 27/04/2016
 * Time: 04:02 PM
 */

namespace App\View;


class InputObject extends MdObject {

  protected $type, $required, $pattern, $ngModel, $name, $label, $formName;
  protected $ngMessage;
  protected $isNum, $_min, $_max;
  protected $inpAttr;
  public $autoMessage;

  /**
   * InputObject constructor.
   * @param $ngModel
   * @param string $label
   */
  public function __construct($ngModel, $label = '') {
    $this->type = 'text';
    $this->ngModel = $ngModel;
    $this->label = $label;
    $this->ngMessage = [];
    $this->inpAttr = [];
    $this->autoMessage = TRUE;
    $this->required = FALSE;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param array $inpAttr
   */
  public function setInpAttr($inpAttr) {
    array_push($this->inpAttr, $inpAttr);
    return $this;
  }


  /**
   * @param mixed $type
   */
  public function setType($type) {
    $this->type = $type;
    if ($type == 'email') {
      $this->setMessage('email', 'ایمیل وارد شد اشتباه است.');
    }
    return $this;
  }

  /**
   * @return mixed
   */
  public function getRequired() {
    if (!isset($this->required)) {
      return FALSE;
    }
    return $this->required;
  }

  /**
   * @param mixed $required
   */
  public function setRequired($required) {
    $this->required = $required;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getPattern() {
    if (!isset($this->pattern)) {
      return FALSE;
    }
    return $this->pattern;
  }

  /**
   * @param mixed $pattern
   */
  public function setPattern($pattern) {
    $this->pattern = $pattern;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getNgModel() {
    if (!isset($this->ngModel)) {
      return FALSE;
    }
    return $this->ngModel;
  }

  /**
   * @param mixed $ngModel
   */
  public function setNgModel($ngModel) {
    $this->ngModel = $ngModel;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getName() {
    if (!isset($this->name)) {
      return FALSE;
    }
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getLabel() {
    if (!isset($this->label)) {
      return FALSE;
    }
    return $this->label;
  }

  /**
   * @param mixed $label
   */
  public function setLabel($label) {
    $this->label = $label;
    return $this;
  }

  public function hasMessage($formName = NULL, $name = NULL) {
    if (isset($formName)) {
      $this->formName = $formName;
      if (isset($name)) {
        $this->name = $name;
      }
    }
    else {
      return isset($this->formName);
    }
  }

  public function setMessage($ngMessage, $text) {
    array_push($this->ngMessage, ['ngMessage' => $ngMessage, 'text' => $text]);
  }


  public function numeric() {
    $this->isNum = TRUE;
    $this->pattern = '/^[0-9]{0,15}$/';
    return $this;
  }

  public function float() {
    $this->isNum = TRUE;
    $this->pattern = '/^[0-9]+([\.,][0-9]+)?$/';
  }

  public function max($val) {
    $this->_max = $val;
  }

  public function min($val) {
    $this->_min = $val;
  }

  public function minMax($min, $max) {
    $this->_min = $min;
    $this->_max = $max;
  }


  /**
   * @return mixed
   */
  public function getMaxLength() {
    if (!isset($this->_max)) {
      return FALSE;
    }
    return $this->_max;
  }


  /**
   * @return mixed
   */
  public function getMinLength() {
    if (!isset($this->_min)) {
      return FALSE;
    }
    return $this->_min;
  }

  public function export() {
    if ($this->autoMessage) {
      if ($this->getRequired()) {
        $this->setMessage('required', trans('validation.required', ['attribute' => $this->label]));
      }

      if ($this->getPattern()) {
        $this->setMessage('pattern', trans('validation.pattern', ['attribute' => $this->label]));
      }

      if ($this->getMaxLength()) {
        $this->setMessage('md-maxlength', trans('validation.max.string', [
          'attribute' => $this->label,
          'max' => $this->_max
        ]));
      }

      if ($this->getMinLength()) {
        $this->setMessage('md-minlength', trans('validation.min.string', [
          'attribute' => $this->label,
          'min' => $this->_min
        ]));
      }
    }
    $export = [];
    foreach (get_class_vars(get_class($this)) as $name => $value) {
      if ($this->{$name}) {
        $export[$name] = $this->{$name};
      }
    }
    return $export;
  }

  public function form($form = NULL) {
    $this->formName = (is_null($form)) ? 'Form' : $form;
    return $this;
  }

}