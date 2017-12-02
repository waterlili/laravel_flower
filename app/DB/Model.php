<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01/09/2016
 * Time: 10:33 PM
 */

namespace App\DB;


use Illuminate\Support\Facades\App;
use Morilog\Jalali\jDate;

class Model extends \Illuminate\Database\Eloquent\Model {
  public static $formatJ = 'Y/n/j-H:i';

  public static $selectCUJ = [
    'created_at as created_at_j',
    'updated_at as updated_at_j',
  ];

  public static $selectCJ = 'created_at as created_at_j';

  public static $selectUJ = 'updated_at as updated_at_j';
  public static $SELECT_STS_STR = 'sts as sts_str';


  public static function selectWithjDate() {
    return array_merge(['*'], self::$selectCUJ);
  }

  public function getCreatedAtJAttribute($value) {
    return $this->convertDate($value);
  }

  public function getUpdatedAtJAttribute($value) {
    return $this->convertDate($value);
  }

  protected function convertDate($value, $format = NULL) {
    if (is_null($value)) {
      return NULL;
    }
    if (is_null($format)) {
      $format = self::$formatJ;
    }
    return jDate::forge($value)->format($format, TRUE);
  }
}