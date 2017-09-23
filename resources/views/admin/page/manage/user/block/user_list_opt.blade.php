<div layout-gt-md="row" layout-align='start center'>
    <div>
        <md-switch ng-model="row.active" ng-change="change(row)">

        </md-switch>
        <md-tooltip>فعال / غیر فعال</md-tooltip>
    </div>
    @include('admin.block.editBtn' , ['url'=>'console/manage/user-edit' , 'row'=>'row' , 'ctrl'=>'UserCtrl' , 'where'=>'user' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>trans('field.user') , 'where'=>'user'])
</div>