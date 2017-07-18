<div class="p-md">
    <h3 class="b mb-md"><% trans('subject.proceed_order') %></h3>
    <md-divider></md-divider>
</div>
<div layout-gt-md="row" layout-align="start center" class="p-md">
    <div layout-gt-md="row" layout-align="start start" flex-gt-md="50">
        <md-input-container>
            <label><% trans('field.description') %></label>
            <input type="text" ng-model="row.description">
        </md-input-container>
    </div>
    <div flex></div>
    <md-button class="md-icon-button" ng-click="proceed(row)">
        <i class="material-icons md-dark">done</i>
        <md-tooltip><% trans('subject.proceed') %></md-tooltip>
    </md-button>
</div>