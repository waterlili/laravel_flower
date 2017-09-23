@section('md_select')
    <fieldset>
        <legend><% trans('fee.select_currency') %></legend>
        <div layout-gt-md="row" layout-align="start center" class="p-md">
            <div class="mh-md" flex-gt-md="50">
                <label><% trans('field.to_currency') %></label>
                @include('MD.input.currency' , ['model'=>'data.to' , 'items'=>'currency'])
            </div>
            <i class="material-icons md-dark md-36" hide-lt-md>trending_flat</i>
            <div class="mh-md" flex-gt-md="50">
                <label><% trans('field.from_currency') %></label>
                @include('MD.input.currency' , ['model'=>'data.currency' , 'items'=>'currency'])
            </div>
        </div>
    </fieldset>
@endsection
<?php
$page = new \App\View\PageGenerator();
$input = new \App\View\InputObject('data.percent', trans('field.fee'));
$max = new \App\View\InputObject('data.max', trans('field.maximum'));
$input->float();
$max->setInpAttr('format-as-currency');
$input->hasMessage('Form', 'fee');
$max->hasMessage('Form', 'max');
$input->setRequired(true);

?>

@section('fee')
    <fieldset>
        <legend><% trans('fee.fee_input') %></legend>
        <div layout-gt-md="row" layout-align="start center">
            <div flex-gt-md="33">
                @include('MD.input.text' , $input->export())
            </div>
            <div flex-gt-md="33">
                @include('MD.input.text' , $max->export())
            </div>
        </div>
    </fieldset>
    <div class="mt-md" layout-gt-md="row">
        <div flex></div>
        <div flex-gt-md="33">@include('MD.input.date_text' , ['model'=>'data.at' ,'name'=>'at'])</div>
    </div>
@endsection


<?php
$page->section('md_select');
$page->section('fee');
?>
<section class="w-box p-md">
    <div class="p-md">
        Set Fee
    </div>
    <md-divider class="mv-md"></md-divider>
    <?php print $page->render(); ?>
</section>



