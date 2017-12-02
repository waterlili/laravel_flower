<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\jDate;

class Controller extends BaseController {
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  protected static $cols = [
    'A1',
    'B1',
    'C1',
    'D1',
    'E1',
    'F1',
    'G1',
    'H1',
    'I1',
    'J1',
    'K1',
    'L1',
    'M1',
    'N1',
    'O1'
  ];

    protected function tableEngine(&$records, $input, $ret = false)
    {
    $this->tableFilter($records, $input);
    $this->tableBtnFilter($records, $input);

    if (isset($input['excelExport'])) {
      return $this->tableExcel($records, $input);
    }


    if (isset($input['exportPrint'])) {
      return $this->tablePrint($records, $input);
    }

    $count = $records->count();

    $this->tablePaginate($records, $input);
        if ($ret) {
            return [
                'rows' => $records->get()->toArray(),
                'total' => $count
            ];
        }
    return response()->json([
      'rows' => $records->get()->toArray(),
      'total' => $count
    ]);
  }

  protected function tableBtnFilter(&$record, $input) {
    if (isset($input['btnFilter']) && is_array($input['btnFilter']) && sizeof($input['btnFilter']) != 0) {
      foreach ($input['btnFilter'] as $btn) {
        if (method_exists($this, $btn)) {
          $this->{$btn}($record);
        }
      }
    }
  }


  protected function tablePrint(&$record, $input) {
    $record->limit(250);
    $export = [];
    foreach ($record->get()->toArray() as $index => $item) {
      $export[$index] = [];
      foreach ($input['cols'] as $col) {
        array_set($export[$index], $col, array_get($item, $col));
      }
    }
    session()->put('table_print', $export);
    session()->put('table_cols', $input['cols']);
    session()->put('table_print_title', $input['ngtRoute']);
    return response()->json(TRUE);
  }

  protected function tablePaginate(&$record, $input) {
    if (isset($input['count'])) {
      $record = $record->take($input['count'])
        ->offset($input['count'] * ($input['page'] - 1));
    }
  }

  protected function tableExcel(&$records, $input) {
    $records->limit(250);
    $export = $this->excelArrayParser($records->get()
      ->toArray(), $input['cols']);

    $excel = Excel::create(jDate::forge()
      ->format('ymdhis'), function ($excel) use ($export) {
      $excel->sheet('Sheet', function ($sheet) use ($export) {
        $sheet->fromArray($export);
        foreach (self::$cols as $k => $col) {
          if (!isset($sheet->data[0][$k])) {
            break;
          }
          $sheet->setCellValue($col, trans('cols.' . str_replace('.', ',', $sheet->data[0][$k])));
        }

      });

    });
    if (isset($input['pdfExport'])) {
      $excel = $excel->store('pdf', storage_path('app/excel/export'));
    }
    else {
      $excel = $excel->store('xlsx', storage_path('app/excel/export'));
    }
    return response()->json(['file' => $excel->filename . '.' . $excel->ext]);
  }

  protected function excelArrayParser($array, $cols) {
    $export = [];

    foreach ($array as $k => $record) {
      foreach ($record as $key => $item) {
        foreach ($cols as $col) {
          if (!isset($export[$k])) {
            $export[$k] = [];
          }
          $export[$k][$col] = array_get($record, $col);

        }
      }
    }
    return $export;
  }

  protected function tableFilter(&$record, $input) {
    if (isset($input['sorting'])) {
      if (sizeof($input['sorting'])) {
        foreach ($input['sorting'] as $key => $val) {
          $record = $record->orderBy($key, $val);
        }
      }
      else {
        $record = $record->orderBy('id', 'DESC');
      }
    }


    if (isset($input['filter'])) {

      foreach ($input['filter'] as $item) {
        if (!isset($item['ini'])) {
          continue;
        }
        if (sizeof(explode('.', $item['value'])) > 1) {
          $exp = explode('.', $item['value']);
          $record->whereHas($exp[0],
            function ($query) use ($exp, $item) {
              $item['value'] = $exp[1];
              $this->whereFilter($query, $item);
//              $query->where($exp[1], 'LIKE', "%" . $item['ini'] . "%");
            }
          );
          continue;
        }
        $this->whereFilter($record, $item);
      }
    }
  }

  protected function whereFilter(&$record, $item) {
    switch ($item['type']) {
      case 'text':
      case 'switch':
      case 'select':
        if ($item['cr'] == 'or') {
          $record->orWhere($item['value'], 'LIKE', "%" . $item['ini'] . "%");
        }
        elseif ($item['cr'] == 'not') {
          $record->where($item['value'], 'NOT LIKE', "%" . $item['ini'] . "%");
        }
        elseif ($item['cr'] == 'and') {
          $record->where($item['value'], 'LIKE', "%" . $item['ini'] . "%");

        }
        break;
      case 'date':

        if ($item['cr'] == 'or') {
            $record->orWhereDate($item['value'], $this->getSymWhenDate($item['when']), $item['ini']);
        }
        elseif ($item['cr'] == 'not') {
            $record->whereDate($item['value'], $this->getNotLikeSymWhenDate($this->getSymWhenDate($item['when'])), $item['ini']);
        }
        elseif ($item['cr'] == 'and') {
            $record->whereDate($item['value'], $this->getSymWhenDate($item['when']), $item['ini']);
        }
        break;
      case 'number':

        if ($item['cr'] == 'or') {
          $record->orWhere($item['value'], $this->getSymWhenDate($item['when']), $item['ini']);
        }
        elseif ($item['cr'] == 'not') {
          $record->where($item['value'], $this->getNotLikeSymWhenDate($this->getSymWhenDate($item['when'])), $item['ini']);
        }
        elseif ($item['cr'] == 'and') {
          $record->where($item['value'], $this->getSymWhenDate($item['when']), $item['ini']);
        }
        break;
    }
  }

  protected function getSymWhenDate($when) {
    $arr = [
      1 => '>',
      2 => "<",
      3 => '='
    ];
    return array_get($arr, $when, '=');
  }

  protected function getNotLikeSymWhenDate($when) {
    $arr = [
      '<' => '>',
      '>' => "<",
      '=' => '<>'
    ];
    return array_get($arr, $when, '<>');
  }
}
