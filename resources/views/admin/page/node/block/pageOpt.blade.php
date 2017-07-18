<div layout-gt-md="row" layout-align='start center'>
    @include('admin.block.editBtn' , ['url'=>'console/node/page-edit' , 'row'=>'row' , 'ctrl'=>'AddPageCtrl' , 'where'=>'node' , 'id'=>'row.id'])
    @include('admin.block.deleteBtn' , ['id'=>'row.id' , 'title'=>trans('field.node') , 'where'=>'node'])
</div>