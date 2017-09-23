<div layout="row" layout-align="start center" ng-controller="FlowerPacketListCtrl">
    <md-button class="md-icon-button md-accent" ng-click="showDialog(row , $event)">
        <i class="material-icons ">remove_red_eye</i>
        <md-tooltip>نمایش اطلاعات</md-tooltip>
    </md-button>
    @include('admin.block.editBtn' , ['url'=>'console/flower_packet/edit' , 'row'=>'row' , 'ctrl'=>'FlowerPacketAddCtrl' , 'where'=>'flower_packets' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'flower_packet' , 'where'=>'flower_packets'])
</div>