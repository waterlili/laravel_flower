<?php
$input = App\View\Text::create($name . '.name', $title)->export();
$packet_price = App\View\Text::create('packet_type.price', 'قیمت')->export();
?>
<div class="w-box p-md mh-md mb-md">
    <header class="w-box-header h-md"><% $title %></header>
    <div layout="row" layout-align="start center">
        @include('MD.input.text' , $input)
        @if($name == 'packet_type')
            @include('MD.input.text' , $packet_price)
        @endif
        <md-button ng-click="<% $name %>.add()" ng-disabled="!<% $name %>.name">ثبت</md-button>

    </div>
    <fieldset>
        <div>
            <div ng-repeat="item in <% $name %>.items" class="const-item" ng-dblclick="<% $name %>.rename(item)">
                <span ng-show="!item._edit_mode">{{item.title}}</span>
                <span ng-show="!item._edit_mode">{{item.price}}</span>

                <div ng-show="item._edit_mode" layout="row" layout-align="start center">
                    <input ng-model="item.title" class="const-input">
                    <div layout="row" layout-align="start center">
                        @include('admin.block.deleteBtn' , ['id'=>'item.id' , 'title'=>'const' , 'where'=>'const' ,'ngTable'=>'tbl'])
                        <button style="background-color: transparent;border: none;" ng-click="<% $name %>.save(item)"><i
                                    class="material-icons md-dark">done</i></button>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>$name.'.errorItems'])
</div>