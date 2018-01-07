<div layout="row" layout-align="start center">
    <md-button class="md-icon-button md-fg md-primary" ng-class="{'md-raised':row.extraRow}"
               ng-click="row.extraRow = !row.extraRow">
        <md-tooltip>نمایش اطلاعات</md-tooltip>
        <i class="material-icons">list</i>
    </md-button>
    @include('admin.block.editBtn' , ['url'=>'console/flower/edit' , 'row'=>'row' , 'ctrl'=>'FlowerAddCtrl' , 'where'=>'flowers' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'flower' , 'where'=>'flowers'])
</div>