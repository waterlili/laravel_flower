<?php
/**
 * Created by PhpStorm.
 * User: AhmadReza
 * Date: 17/04/2016
 * Time: 09:21 PM
 */

namespace App\View;


class MdMenu extends MdObject {


  protected $items, $width, $position, $offset, $ngModel, $trigger, $onOpenMenu, $required;

  /**
   * MenuInput constructor.
   * @param $ngModel
   */
  public function __construct($ngModel) {
    $this->items = [];
    $this->ngModel = $ngModel;
  }

  public function addItem($id, $text, $icon = NULL) {
    array_push($this->items, ['id' => $id, 'text' => $text, 'icon' => $icon]);
  }

  /**
   * @return mixed
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * @return mixed
   */
  public function getPosition() {
    return $this->position;
  }

  /**
   * @return mixed
   */
  public function getOffset() {
    return $this->offset;
  }

  /**
   * @return mixed
   */
  public function getTrigger() {
    return $this->trigger;
  }

  /**
   * @return mixed
   */
  public function getOnOpenMenu() {
    return $this->onOpenMenu;
  }

  /**
   * @param mixed $trigger
   */
  public function setTrigger($trigger) {
    $this->trigger = $trigger;
  }

  /**
   * @param mixed $onOpenMenu
   */
  public function setOnOpenMenu($onOpenMenu) {
    $this->onOpenMenu = $onOpenMenu;
  }

  /**
   * @param mixed $offset
   */
  public function setOffset($offset) {
    $this->offset = $offset;
  }

  /**
   * @param mixed $position
   */
  public function setPosition($position) {
    $this->position = $position;
  }

  /**
   * @param mixed $width
   */
  public function setWidth($width) {
    $this->width = $width;
  }

  /**
   * @return mixed
   */
  public function getRequired() {
    return $this->required;
  }

  /**
   * @param mixed $required
   */
  public function setRequired($required) {
    $this->required = $required;
  }

  public function export() {
    $export = [];
    foreach (get_class_vars(get_class($this)) as $name => $value) {
      if ($this->{$name}) {
        $export[$name] = $this->{$name};
      }
    }
    return $export;
  }
}