<?php
$product = \App\View\Ac::create('prc.item', 'prc.itemOpt', 'console/order/get-product', 'نام یا کد محصول')
        ->export();
$total = \App\View\Text::create('item.total', 'تعداد')
        ->setRequired(true)
        ->numeric()
        ->setName('total')
        ->form()
        ->export();
?>
@extends('admin.block.editDialogMaster')
@section('title' , 'ویرایش محصولات')
@section('content')
    <div style="min-width: 1200px">
        <fieldset class="p-md">
            <legend>لیست اقلام فاکتور</legend>
            <div>
                <div class="p-md w-box blue">
                    <span>جمع اقلام فاکتور</span><span>  {{data.total | currency:'':''}}</span>
                </div>
                <div>
                    {!! $product !!}
                </div>
                <md-divider class="mv-md"></md-divider>
                <table ng-table="tableParams" class="table" show-filter="false">
                    <tr ng-repeat="item in $data">
                        <td title="'عنوان'">
                            {{item.value}}
                        </td>
                        <td title="'مبلغ'">
                            {{item.price | currency:'':''}}
                        </td>
                        <td title="'تعداد'" WIDTH="55px">
                            @include('MD.input.text' ,$total)
                        </td>
                        <td title="'جمع'">
                            {{item.price * item.total | currency:'':''}}
                        </td>
                        <td title="'حذف'">
                            <md-button class="md-icon-button md-warn" ng-click="prc.remove($index)">
                                <i class="material-icons md-18">delete</i>
                            </md-button>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
    </div>
@endsection



<VirtualHost *:80>
    ServerName software.bonita-flower.com
    DocumentRoot /var/www/software
    <Directory /var/www/software >
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    </Directory>

    CustomLog /var/log/httpd/software.bonita-flower.com-access.log combined
    ErrorLog /var/log/httpd/software.bonita-flower.com-error.log

    # Possible values include: debug, info, notice, warn, error, crit,
    # alert, emerg.
    LogLevel warn
</VirtualHost>