<div layout="row" layout-align="start center">
    <md-button class="md-icon-button md-accent" ng-click="orderDialog(row , $event)">
        <i class="material-icons ">assignment</i>
        <md-tooltip>سفارش ها</md-tooltip>
    </md-button>
    @include('admin.block.editBtn' , ['url'=>'console/customer/edit' , 'row'=>'row' , 'ctrl'=>'CustomerAddCtrl' , 'where'=>'customer' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'customer' , 'where'=>'customer'])
</div>