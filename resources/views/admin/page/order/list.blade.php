<?php
$tabs = [
        [
                'title' => 'لیست سفارش ها',
                'sref' => 'consoleorderlist.list'
        ],
        [
                'title' => 'سفارش های تایید نشده',
                'sref' => 'consoleorderlist.unverified'
        ],
];
?>
@include('MD.tab.tab' ,['tabs'=>$tabs])