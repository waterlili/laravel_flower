<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02/05/2016
 * Time: 09:32 AM
 */

namespace App\View;


abstract class MdObject {
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