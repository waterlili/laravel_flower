<?php

namespace App\View;


class Header extends ArView {
  protected $title;
  /**
   * Header constructor.
   * @param $title
   */
  public function __construct($title) {
    $this->title = $title;
    $this->setBox([
      'layout-padding',
      'layout-gt-md' => 'row',
      'layout-align-gt-md' => 'start center'
    ]);
    $this->export = $this->title;
  }
}