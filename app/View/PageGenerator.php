<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01/09/2016
 * Time: 04:22 PM
 */

namespace App\View;


use GuzzleHttp\Psr7\Request;

class PageGenerator {
  protected $rows, $submit, $notice;

  /**
   * PageGenerator constructor.
   */
  public function __construct() {
    $this->rows = [];
    $this->notice = TRUE;
    $this->submit = trans('field.submit');
  }

  /**
   * @return mixed
   */
  public function getSubmit() {
    return $this->submit;
  }

  /**
   * @param mixed $submit
   */
  public function setSubmit($submit) {
    $this->submit = $submit;
  }
  
  
  


  public function inc($inc, $data, $input_cnt = FALSE) {
    $tmp = '';
    if ($input_cnt) {
      $tmp .= '<div class="input-cnt p-md mb-md">';
    }
    $tmp .= view()
      ->make($inc, $data, array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))
      ->render();
    if ($input_cnt) {
      $tmp .= '</div>';
    }
    $this->rows[] = $tmp;
  }

  public function addGrid(Grid $grid) {
    $this->rows[] = $grid->render();
  }


  public function section($name) {
    $this->rows[] = view()->yieldContent($name);
  }


  public function render() {
    $tmp = [];
    $tmp[] = '<form name="Form">';
    foreach ($this->rows as $item) {
      $tmp[] = $item;
    }
    if ($this->notice) {
      $tmp[] = view()->make('MD.Notice.notice', [
        'type' => 'error',
        'repeat' => 'errorItem'
      ], array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))->render();

      $tmp[] = view()->make('MD.Notice.notice', [
        'type' => 'info',
        'repeat' => 'infoItem'
      ], array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))->render();
    }


    if ($this->submit) {
      $tmp[] = view()->make('MD.button.submit', [
        'submit' => 'submit()',
        'title' => $this->submit
      ], array_except(get_defined_vars(), array(
        '__data',
        '__path'
      )))->render();
    }
    $tmp[] = '</form>';
    return join('', $tmp);
  }
}