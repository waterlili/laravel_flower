<div layout="row" layout-align="start center" ng-controller="FlowerPacketListCtrl">
    <md-button class="md-icon-button md-fg md-primary" ng-class="{'md-raised':row.extraRow}"
               ng-click="row.extraRow = !row.extraRow">
        <md-tooltip>نمایش اطلاعات</md-tooltip>
        <i class="material-icons">list</i>
    </md-button>
    @include('admin.block.editBtn' , ['url'=>'console/flower_packet/edit' , 'row'=>'row' , 'ctrl'=>'FlowerPacketAddCtrl' , 'where'=>'flowerpackets' , 'id'=>'row.id' ,'table'=>'tbl'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'flower_packet' , 'where'=>'flower_packets'])
</div>