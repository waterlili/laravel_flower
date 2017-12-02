<?php

namespace App\View;

class ListShow {
  private $col;

  public static function generate($obj, $col = 4, $size = 'md') {
    $export = '';
    $tmp = [];
    foreach ($obj as $v) {
      if (!in_array('br', $v) && !in_array('hr', $v)) {
        if (($v[0] != '') && (!isset($v[1]) || $v[1] == '')) {
          $v[1] = '<span class="md-fg md-warn">مشخص نشده</span>';
        }
        $tmp[] = ['title' => $v[0], 'value' => $v[1]];
      }

      if (in_array('hr', $v) || in_array('br', $v) || $v == last($obj)) {
        $export .= view()->make('MD.item.item-obj')->with([
          'col' => $col,
          'size' => $size,
          'items' => $tmp
        ]);
        $tmp = [];
      }
      if (in_array('br', $v)) {
        $export .= '<br>';
      }
      elseif (in_array('hr', $v)) {
        $export .= '<div layout="row" layout-align="start center" class="mv-md md-fg"><i class="material-icons">' . $v['icon'] . '</i><span class="pl-sm">' . $v['title'] . '</span><hr flex></div>';
      }
    }
    echo $export;
//    echo view()->make('MD.item.item-viewer')->with([
//      'title' => $title,
//      'value' => $value
//    ]);
  }


}