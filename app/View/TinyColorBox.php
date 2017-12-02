<?php
namespace App\View;


class TinyColorBox extends ArView {
  public $color, $title, $value, $left;

  /**
   * TinyColorBox constructor.
   * @param $color
   * @param $title
   * @param $value
   * @param $left
   */
  public function __construct($color, $title, $value, $left = FALSE) {
    $this->color = $color;
    $this->title = $title;
    $this->value = $value;
    $this->left = $left;
    $this->init();
  }


  protected function init() {
    $this->setBox([
      'class' => $this->color . ' mt tac',
      'layout' => 'row'
    ]);
    $this->addPrefix('<div flex="60" layout-padding class="left-color-box">', 11);

    $this->export = '<h4 class="h4">'.$this->title.'</h4><h1 class="h1 mt">'.$this->value.'</h1>';
    $this->addSuffix('</div>', 11);
    $this->addSuffix('<div flex="40" layout-padding class="right-color-box"></div>', 10);
  }

}