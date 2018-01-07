<div layout="row" layout-align="start center">
    <md-button class="md-icon-button md-fg md-primary" ng-class="{'md-raised':row.extraRow}"
               ng-click="row.extraRow = !row.extraRow">
        <md-tooltip>نمایش اطلاعات</md-tooltip>
        <i class="material-icons">list</i>
    </md-button>
    @include('admin.block.editBtn' , ['url'=>'console/flower_package/edit' , 'row'=>'row' , 'ctrl'=>'FlowerPackageAddCtrl' , 'where'=>'flower_packages' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>'flower_package' , 'where'=>'flower_packages'])
</div>