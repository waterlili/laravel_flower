<ui-select ng-model="<% $model %>" theme="select2"
           style="min-width: 100%;" title="<% trans('public.choose_currency') %>">
    <ui-select-match
            placeholder="<% trans('public.currency') %>">
        <div layout="row" layout-align="start center" style="font-size: 1.2em">
            <span class="flag-icon flag-icon-{{$select.selected.icon}} flag-icon-squared mr-md lh-2 "></span>
            <span style="vertical-align: super">{{$select.selected.value}} | <b>{{$select.selected.short}}</b></span>
        </div>
    </ui-select-match>
    <ui-select-choices repeat="item in (<% $items %> | filter: $select.search) track by item.id">
        <div layout="row" layout-align="start center" style="font-size: 1.2em">
            <span class="flag-icon flag-icon-{{item.icon}} flag-icon-squared mr-md lh-2 "></span>
            <span style="vertical-align: super">{{item.value}} | <b>{{item.short}}</b></span>
        </div>
    </ui-select-choices>
</ui-select>