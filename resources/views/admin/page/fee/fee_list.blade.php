<?php
$table = new \App\View\NgTable(trans('subject.fee_list'), 'tbl', 'console/fee/fee-list');
$table->addInclude('currency_str', trans('field.currency'), 'admin.page.fee.block.currency_flag', ['item' => 'currency_str'], 'currency')
        ->addInclude('to_str', trans('field.to_fee'), 'admin.page.fee.block.currency_flag', ['item' => 'to_str'], 'to_title')
        ->addCol('percent', trans('field.fee'))
        ->addCol('max', trans('field.max'), null, true, FALSE, 'currency:"$":0')
        ->addCol('updated_at_j', trans('field.updated_at'), 'updated_at')
        ->addInclude('opt', trans('field.operation'), 'admin.page.fee.block.feeOpt');
$table->extraRow('admin.page.fee.block.extraRowFee');
?>

<section class="w-box p-md">
    @include('MD.table.table' , $table->export())
</section>