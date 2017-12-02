<ui-select ng-model="$parent.<% $ngModel %>" theme="select2" style="min-width: 100%;">
    <ui-select-match>
        <span ng-bind="$select.selected.<% $itemValue %>"></span>
    </ui-select-match>
    <ui-select-choices repeat="item in (<% $object %> | filter: $select.search) track by item.id">
        <span style="padding-right: {{10*item.depth}}px;margin-right: {{10*item.depth}}px" ng-bind="item.<% $itemValue %>"></span>
    </ui-select-choices>
</ui-select>