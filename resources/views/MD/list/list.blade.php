<md-list ng-cloak>
    @if(isset($title))
    <md-subheader class="md-no-sticky"><% $title %></md-subheader>
    @endif
    <md-list-item ng-repeat="item in <% $list %>" layout="row" layout-align="center center">
        @yield($section)
        @if(isset($hasCheckbox))
            <md-checkbox class="md-secondary" ng-model="item.checkbox"></md-checkbox>
        @endif
    </md-list-item>
</md-list>