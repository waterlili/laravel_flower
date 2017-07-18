<span ng-init="<% $ngModel %>.items = <% json_encode($items) %>"></span>
<md-menu>
    <md-button class="md-raised" ng-click="$mdOpenMenu($event)">
        {{<% $ngModel %>.title}}
    </md-button>
    <md-menu-content width="<% $width or 4 %>">
        <md-menu-item ng-repeat="item in <% $ngModel %>.items">
            <md-button ng-click="<% $ngModel %>.<% $trigger or "" %>" layout="row" layout-align="start center" style="display: flex">
                <i class="material-icons">{{item.icon}}</i>
                <span flex></span>
                <span style="line-height: 1;">{{item.text}}</span>
            </md-button>
        </md-menu-item>
    </md-menu-content>
</md-menu>
