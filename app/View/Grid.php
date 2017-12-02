<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01/09/2016
 * Time: 04:48 PM
 */

namespace App\View;


class Grid {
  protected $export, $grids;
  protected $wrapper_start, $wrapper_end, $align;

  /**
   * Grid constructor.
   */
  public function __construct() {
    $this->export = [];
    $this->align = 'start center';
    $this->wrapper_start = '<div layout-gt-md="row" layout-align="' . $this->align . '">';
    $this->wrapper_end = '</div>';
  }

  public function align($text){
    $this->wrapper_start = '<div layout-gt-md="row" layout-align="' . $text . '">';
    $this->wrapper_end = '</div>';
  }

  public function grid() {
    $this->grids = func_get_args();
    foreach ($this->grids as $key => $item) {
      $this->export[$key] = [
        '<div flex-gt-md="' . $item . '">',
        '',
        '</div>'
      ];
    }
    return $this;
  }

  public function section($index, $name, $input_cnt = FALSE) {
    $wrapper_start = '';
    $wrapper_end = '';
    if ($input_cnt) {
      $wrapper_start = '<div class="input-cnt p-md mb-md mh-md-md">';
      $wrapper_end = '</div>';
    }

    $this->export[$index][1] = $wrapper_start . view()->yieldContent($name) . $wrapper_end;
    return $this;
  }

  public function inc($index, $content, $data = [], $input_cnt = FALSE) {

    $wrapper_start = '';
    $wrapper_end = '';
    if ($input_cnt) {
      $wrapper_start = '<div class="input-cnt p-md mb-md">';
      $wrapper_end = '</div>';
    }

    $this->export[$index][1] = $wrapper_start . view()
        ->make($content, $data, array_except(get_defined_vars(), array(
          '__data',
          '__path'
        )))
        ->render() . $wrapper_end;
    return $this;
  }

  public function render() {
    $tmp = [];
    $tmp[] = $this->wrapper_start;
    foreach ($this->export as $item) {
      $tmp[] = join('', $item);
    }
    $tmp[] = $this->wrapper_end;
    return join('', $tmp);
  }
}