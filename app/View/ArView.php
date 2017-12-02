<?php
/**
 * Created by PhpStorm.
 * User: AhmadReza
 * Date: 14/04/2016
 * Time: 07:55 PM
 */

namespace app\View;


abstract class ArView {

  protected $export;
  protected $has_box;
  protected $_prefix = [], $_suffix = [];

  public function render() {
    $_p = array_sort($this->_prefix, function ($value) {
      return $value['w'];
    });

    $_s = array_sort($this->_suffix, function ($value) {
      return $value['w'];
    });
    $_s = array_reverse($_s);
    $_p = array_pluck($_p, 'mark');
    $_s = array_pluck($_s, 'mark');
    $_p = join(' ', $_p);
    $_s = join(' ', $_s);
    return $_p . $this->export . $_s;
  }

  public function setBox($attr = []) {
    $this->has_box = TRUE;
    $this->addPrefix('<section ', 1);
    if (!isset($attr['class'])) {
      $attr['class'] = 'w-box';
    }
    else {
      $attr['class'] .= ' w-box';
    }
    foreach ($attr as $key => $item) {
      if (is_numeric($key)) {
        $this->addPrefix($item . " ", 2);
      }
      else {
        $this->addPrefix($key . '="' . $item . '" ', 2);
      }
    }
    $this->addPrefix('>', 3);
    $this->addSuffix('</section>', 1);
  }


  protected static function addAtr($str, $attr) {
    foreach ($attr as $key => $item) {
      if (is_numeric($key)) {
        $str .= $item . " ";
      }
      else {
        $str .= $key . '="' . $item . '" ';
      }
    }
    return $str;
  }


  protected static function elm($name, $attr, $content) {
    $tmp = '<' . $name . ' ';
    $tmp = self::addAtr($tmp, $attr);
    $tmp .= ' >';
    $tmp .= $content;
    $tmp .= '</' . $name . '>';
    return $tmp;
  }


  /**
   * @param $mark
   * @param $w
   */
  protected function addPrefix($mark, $w = 1) {
    $this->_prefix[] = ['mark' => $mark, 'w' => $w];
  }

  protected function addSuffix($mark, $w = 1) {
    $this->_suffix[] = ['mark' => $mark, 'w' => $w];
  }
}