<?php
/**
 * Created by PhpStorm.
 * User: AhmadReza
 * Date: 17/04/2016
 * Time: 09:17 PM
 */

namespace App\View;


use Illuminate\View\View;

class Window extends ArView {
  protected $hasRefresh, $hasMenu;
  protected $color;
  protected $menu;

  /**
   * Window constructor.
   * @param bool $hasRefresh
   * @param $menu
   */
  public function __construct() {
    $btn = view('MD.tile.tile', ['arr' => 'Hello !']);
//    print_r($btn->render());
//    $this->export = $btn->render();
  }

  /**
   * @return mixed
   */
  public function getMenu() {
    return $this->menu;
  }

  /**
   * @param mixed $menu
   */
  public function setMenu($menu) {
    $this->menu = $menu;
  }

  /**
   * @return boolean
   */
  public function isHasRefresh() {
    return $this->hasRefresh;
  }

  /**
   * @param boolean $hasRefresh
   */
  public function setHasRefresh($hasRefresh) {
    $this->hasRefresh = $hasRefresh;
  }


  public function setColor($color = '') {
    $this->color = $color;

  }
}