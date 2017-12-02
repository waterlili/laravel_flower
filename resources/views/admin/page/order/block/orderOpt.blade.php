<div layout="row" layout-align="start center">
    @if(FALSE)
        <md-button class="md-icon-button md-fg md-primary" ng-class="{'md-raised':row.extraRow}"
                   ng-click="row.extraRow = !row.extraRow">
            <md-tooltip>نمایش محصولات</md-tooltip>
            <i class="material-icons">list</i>
        </md-button>
        <md-button class="md-icon-button md-accent"
                   ng-disabled="row.visitor"
                   ng-click="setVisitor(row)">
            <md-tooltip>ثبت بازاریاب</md-tooltip>
            <i class="material-icons">add_shopping_cart</i>
        </md-button>

        <md-button class="md-icon-button md-accent"
                   ng-disabled="row.sender"
                   ng-click="setSender(row)">
            <md-tooltip>ثبت تحویل دهنده</md-tooltip>
            <i class="material-icons">motorcycle</i>
        </md-button>

        <div>
            <md-switch class="md-accent"
                       ng-model="row.sts"
                       ng-true-value="'1'"
                       ng-false-value="'-1'"
                       ng-change="setSts(row)">

            </md-switch>
            <md-tooltip>پرداخت سفارش</md-tooltip>
        </div>

        @include('admin.block.editBtn' , ['url'=>'console/order/edit' , 'row'=>'row' , 'ctrl'=>'OrderEditCtrl' , 'where'=>'order' , 'id'=>'row.id'])
    @endif
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'order' , 'where'=>'order'])
</div>


