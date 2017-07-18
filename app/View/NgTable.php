<?php
namespace App\View;


class NgTable extends MdObject {

  protected $header, $ngTable, $ngtRoute, $ngFilter, $view_show, $filter_show, $ngCols, $extraRow, $btnFilter;

  /**
   * NgTable constructor.
   * @param $header
   * @param $ngTable
   * @param $ngtRoute
   * @param bool $view_show
   * @param bool $filter_show
   */
  public function __construct($header, $ngTable, $ngtRoute, $view_show = 'show_view', $filter_show = 'show_filter') {
    $this->header = $header;
    $this->ngTable = $ngTable;
    $this->ngtRoute = $ngtRoute;
    $this->view_show = $view_show;
    $this->filter_show = $filter_show;
    $this->ngCols = [];
    $this->ngFilter = [];
  }

  public function addCol($key, $dataTitle, $sort = NULL, $defaultView = TRUE, $const = FALSE, $view_filter = NULL) {

    if (is_null($sort)) {
      $sort = $key;
    }

    $tmp = [
      'data-title' => $dataTitle,
      'sort' => "'$sort'",
      'default-view' => $defaultView
    ];

    if ($const) {
      $tmp['const'] = $const;
    }

    if (!is_null($view_filter)) {
      $tmp['view_filter'] = $view_filter;
    }
    $this->ngCols[$key] = $tmp;
    return $this;
  }

  public function addMore($key, $dataTitle, $sort = NULL, $defaultView = TRUE, $const = FALSE, $view_filter = NULL) {

    if (is_null($sort)) {
      $sort = $key;
    }

    $tmp = [
      'data-title' => $dataTitle,
      'sort' => "'$sort'",
      'more' => TRUE,
      'default-view' => $defaultView
    ];

    if ($const) {
      $tmp['const'] = $const;
    }

    if (!is_null($view_filter)) {
      $tmp['view_filter'] = $view_filter;
    }
    $this->ngCols[$key] = $tmp;
    return $this;
  }


  public function addInclude($key, $title, $link, $vars = [], $sort = NULL) {
    $this->ngCols[$key] = [
      'data-title' => $title,
      'const' => TRUE,
      'sort' => "'$sort'",
      'include' => [
        'link' => $link,
        'vars' => $vars
      ]
    ];
    return $this;
  }

  public function addFilter($key, $title, $value, $type, $select = NULL) {

    $this->ngFilter[$key] = [
      'title' => $title,
      'value' => $value,
      'type' => $type,
      'select' => $select
    ];
    return $this;
  }


  public function extraRow($link, $vars = []) {
    $this->extraRow = ['include' => $link, 'vars' => $vars];
    return $this;
  }

  /**
   * @return mixed
   */
  public function getBtnFilter() {
    return $this->btnFilter;
  }

  /**
   * @param mixed $btnFilter
   */
  public function addBtnFilter($key, $title) {
    if (is_null($this->btnFilter)) {
      $this->btnFilter = [];
    }
    $this->btnFilter[$key] = $title;
  }


}