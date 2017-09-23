<?php
$table = new \App\View\NgTable(trans('subject.page_list'), 'tbl', 'console/node/page-list');
$table
        ->addCol('title', trans('field.title'))
        ->addCol('url', trans('field.url'))
        ->addCol('created_at_j', trans('field.created_at'), 'created_at')
        ->addCol('updated_at_j', trans('field.updated_at'), 'updated_at')
        ->addInclude('opt', trans('field.operation'), 'admin.page.node.block.pageOpt')
        ->addFilter('title', trans('field.title'), 'title', 'text')
        ->addFilter('url', trans('field.url'), 'url', 'text');
?>

@include('MD.table.table' , $table->export())



