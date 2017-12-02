<?php namespace App\Http;


use Illuminate\Support\Facades\Config;

class UiRoute {
  protected static $routes = [];
  protected static $ui_links = [];

  public static function menu($id, $title, $url, $rid, $extra = []) {
    if (!isset($extra['ui_url'])) {
      $extra['ui_url'] = $url;
    }

    if (!isset($extra['ctrl'])) {
      $extra['ctrl'] = 'AdminCtrl';
    }

    if (!isset($extra['w'])) {
      $extra['w'] = 10;
    }


    $_r = [
      'type' => 'menu',
      'id' => $id,
      'rid' => $rid,
      'title' => $title,
      'url' => $url,
    ];

    $_r = array_merge($_r, $extra);
    if (isset($_r['parent']) && array_has(self::$routes, $_r['parent'])) {
      self::$routes[$_r['parent']]['items'][$id] = $_r;
//      if (!in_array('rid', $_r)) {
//        self::$routes[$parent]['rid'][] = $rid;
//      }
//      $explode = explode('.', $parent);
//      if (!array_has(self::$routes, $parent . '.items')) {
//        self::$routes[$explode[0]]['items'][$explode[2]]['items'] = [];
//      };
//      self::$routes[$explode[0]]['items'][$explode[2]]['items'][$id] = $_r;
//      self::$routes[$explode[0]]['items'][$explode[2]]['rid'][] = $rid;
    }
    else {
      self::$routes[$id] = $_r;
    }
  }


  public static function group($id, $title, $icon, $w = 10, $rid) {
    self::$routes[$id] = [
      'id' => $id,
      'title' => $title,
      'type' => 'group',
      'icon' => $icon,
      'w' => $w,
      'rid' => $rid
    ];
  }

  public static function get_routes() {
    return array_sort(array_reverse(self::$routes), function ($value) {
      return $value['w'];
    });
  }

  public static function getJson() {
    return json_encode(self::get_routes());
  }


  public static function setUrl($url, $sref, $ui = NULL, $ctrl = 'AdminCtrl') {
    if (is_null($ui)) {
      $ui = $url;
    }

    array_push(self::$ui_links, [
      'url' => $url,
      'ui_url' => $ui,
      'sref' => $sref,
      'ctrl' => $ctrl
    ]);
  }

  public static function getUiRoute() {
    $items = [];
    foreach (self::get_routes() as $key => $item) {
      if (isset($item['url'])) {
        array_push($items, [
          'url' => $item['url'],
          'ui_url' => $item['ui_url'],
          'sref' => str_replace('/', '', $item['url']),
          'ctrl' => $item['ctrl'],
          'w' => $item['w']
        ]);
      }
      if (isset($item['items'])) {
        foreach ($item['items'] as $key_2 => $item_2) {
          array_push($items, [
            'url' => $item_2['url'],
            'ui_url' => $item_2['ui_url'],
            'sref' => str_replace('/', '', $item_2['url']),
            'ctrl' => $item_2['ctrl'],
            'w' => $item_2['w']
          ]);
        }
      }
    }

    foreach (self::$ui_links as $item) {
      array_push($items, $item);
    }
    return json_encode($items);
  }
}


$mm = Config::get('menus.groups');

foreach ($mm as $key => $item) {
  UiRoute::group($key, trans($item['title']), $item['icon'], (isset($item['w']) ? $item['w'] : 10), array_get($item, 'rid'));
  if (isset($item['children'])) {
    foreach ($item['children'] as $key_menu => $item_menu) {
      UiRoute::menu($key_menu, trans($item_menu['title']), $item_menu['url'], $item_menu['rid'], [
        'parent' => $key,
        'ctrl' => (isset($item_menu['ctrl']) ? $item_menu['ctrl'] : 'AdminCtrl'),
        'w' => (isset($item_menu['w']) ? $item_menu['w'] : 10)
      ]);
    }
  }
}

//Dashboard
//UiRoute::menu('dashboard', trans('menu.dashboard'), 'console/dashboard', 102, [
//  'icon' => 'dashboard',
////  'ctrl' => 'DashboardCtrl',
//  'w' => 0
//]);

//Dashboard
//UiRoute::menu('dashboard', ' هزینه های جاری', 'console/cost', 102, [
//  'icon' => 'toc',
//  'ctrl' => 'CostCtrl',
//  'w' => 10
//]);


UiRoute::setUrl('console/order/order-list', 'consoleorderlist.list', 'order/list', 'OrderListCtrl');
UiRoute::setUrl('console/order/order-unverified', 'consoleorderlist.unverified', 'order/unverified', 'OrderListCtrl');

