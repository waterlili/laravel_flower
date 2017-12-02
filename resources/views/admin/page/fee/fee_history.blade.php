<?php
$table = new \App\View\NgTable(trans('subject.fee_history'), 'tbl', 'console/fee/fee-history');
$table->addInclude('currency_str', trans('field.currency'), 'admin.page.fee.block.currency_flag', ['item' => 'currency_str'], 'currency')
        ->addInclude('to_str', trans('field.to_fee'), 'admin.page.fee.block.currency_flag', ['item' => 'to_str'], 'to_title')
        ->addCol('percent', trans('field.fee'))
        ->addCol('max', trans('field.max'), null, true, FALSE, 'currency:"$":0')
        ->addCol('created_at_j', trans('field.created_at'), 'created_at');
?>

<section class="w-box p-md">
    @include('MD.table.table' , $table->export())
</section>