<div layout="row" layout-align="start center">
    <md-button class="md-icon-button md-accent" ng-click="showDialog(row , $event)">
        <i class="material-icons ">remove_red_eye</i>
        <md-tooltip>نمایش اطلاعات</md-tooltip>
    </md-button>
    @include('admin.block.editBtn' , ['url'=>'console/flower/edit' , 'row'=>'row' , 'ctrl'=>'FlowerAddCtrl' , 'where'=>'flowers' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'flower' , 'where'=>'flowers'])
</div>