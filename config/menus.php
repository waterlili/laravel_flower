<?php


return [
  'groups' => [
    'customer' => [
      'title' => 'menu.customer',
      'icon' => 'group',
      'w' => 1,
      'children' => [
        'new_customer' => [
          'title' => 'menu.new_customer',
          'url' => 'console/customer/list',
          'ctrl' => 'CustomerListCtrl',
          'rid' => 100,
          'w' => 11
        ],
        'add_customer' => [
          'title' => 'افزودن / ویرایش مشتری',
          'url' => 'console/customer/add',
          'ctrl' => 'CustomerAddCtrl',
          'rid' => 101
        ],
        'test' => [
          'title' => 'تست',
          'url' => 'console/cost/test',
          'ctrl' => 'TestCtrl',
          'rid' => 101
        ],
//        'customer_group' => [
//          'title' => 'گروه بندی مشتریان',
//          'url' => 'console/customer/group',
//          'ctrl' => 'CustomerGroupCtrl',
//          'rid' => 101
//        ]
      ]
    ],
    'order' => [
      'title' => 'menu.orders',
      'icon' => 'receipt',
      'w' => 1,
      'children' => [
        'add' => [
          'title' => 'افزودن سفارش ',
          'url' => 'console/order/add',
          'ctrl' => 'OrderPageCtrl',
          'rid' => 101
        ],
        'orders' => [
          'title' => 'menu.orders',
          'url' => 'console/order/list',
          'rid' => 101
        ],
        'orders-day' => [
          'title' => 'سفارش روز',
          'url' => 'console/order/list-day',
          'ctrl'=>'OrderListDayCtrl',
          'rid' => 101
        ],
        'menu' => [
          'title' => 'گزارش',
          'url' => 'console/order/report',
          'ctrl' => 'OrderReportCtrl',
          'rid' => 101
        ]
      ]
    ],

    'node' => [
      'title' => 'menu.product',
      'icon' => 'description',
      'w' => 2,
      'children' => [
        'node' => [
          'title' => 'menu.product',
          'url' => 'console/product/list',
          'ctrl' => 'ProductListCtrl',
          'rid' => 100,
          'w' => 11
        ],
        'add' => [
          'title' => 'menu.add_product',
          'url' => 'console/product/add',
          'ctrl' => 'ProductAddCtrl',
          'rid' => 101
        ]
      ]
    ],
    'profile' => [
      'title' => 'کاربری',
      'icon' => 'face',
      'rid' => 14,
      'children' => [
        'profile_password' => [
          'title' => 'پروفایل',
          'url' => 'console/profile/settings',
          'ctrl' => 'ProfileCtrl',
          'rid' => 1411
        ],
      ]
    ],
    'manage' => [
      'title' => 'مدیریت سامانه',
      'icon' => 'settings',
      'w' => 2,
      'children' => [
        'user_manage' => [
          'title' => 'menu.users',
          'url' => 'console/manage/users',
          'ctrl' => 'UserCtrl',
          'rid' => 100,
          'w' => 11
        ],
        'role' => [
          'title' => 'قوانین دسترسی',
          'url' => 'console/manage/roles',
          'ctrl' => 'RoleCtrl',
          'rid' => 100,
          'w' => 11
        ],
        'const' => [
          'title' => 'مدیریت ثابت ها',
          'url' => 'console/manage/const',
          'ctrl' => 'ConstCtrl',
          'rid' => 100,
          'w' => 11
        ],
        'log' => [
          'title' => 'رویداد های سیستمی',
          'url' => 'console/manage/log',
          'ctrl' => 'LogCtrl',
          'rid' => 100,
          'w' => 11
        ],
      ]
    ],
  ],
];