<?php
$fee = new \App\View\InputObject('row.percent', trans('field.fee'));
$fee->setRequired(true);
$fee->hasMessage('Form', 'fee');
$fee->numeric();
?>
<div class="p-md">
    <h3 class="b mb-md"><% trans('subject.change_fee') %></h3>
    <md-divider></md-divider>
</div>
<form name="Form">
    <div layout-gt-md="row" layout-align="start center" class="p-md">

        <div layout-gt-md="row" layout-align="start start" flex-gt-md="20">
            @include('MD.input.text', $fee->export())
        </div>
        <div flex></div>
        <md-button class="md-icon-button" ng-click="saveRow(row)">
            <i class="material-icons md-dark">done</i>
            <md-tooltip><% trans('subject.save') %></md-tooltip>
        </md-button>
    </div>
</form>