<div ng-init="<% $ngTable %>.filter.$data = <% json_encode($ngFilter) %>"></div>
<section ng-show="<% $ngTable %>.filter.showFilterSelect" layout="row" layout-align="center center">
    <md-select ng-model="<% $ngTable %>.filter.mdSelect" style="min-width: 250px;margin: 0;"
               ng-change="<% $ngTable %>.filter.addFilter()" placeholder="فیلتر ورودی">
        <md-option ng-repeat="item in <% $ngTable %>.filter.$data" value="{{item.value}}">
            {{item.title}}
        </md-option>
    </md-select>
    <md-button aria-label="menu" class="md-fab md-mini md-warm" layout="row"
               layout-align="center center" ng-click="<% $ngTable %>.filter.hideFS()">
        <i class="material-icons md-light">close</i>
    </md-button>
</section>

<md-button aria-label="menu" class="md-fab md-mini md-primary" layout="row"
           layout-align="center center"
           ng-click="<% $ngTable %>.filter.showFS()"
           ng-show="!<% $ngTable %>.filter.showFilterSelect"
>
    <i class="material-icons md-light">add</i>
</md-button>

<section layout-gt-md="row" layout-align="start center" layout-wrap>
    <div ng-repeat="item in <% $ngTable %>.filter.$items" layout="row" layout-align="center center"
         class="filter-item-wrapper">
        <h4 class="md-caption" layout-padding>{{item.title}}</h4>
        <md-button aria-label="Not" class="md-icon-button" layout="row" layout-align="center center"
                   ng-click="<% $ngTable %>.filter.changeCritical(item)">
            <i class="material-icons md-dark">{{<% $ngTable %>.filter.cr[item.cr].icon}}</i>
            <md-tooltip>
                {{<% $ngTable %>.filter.cr[item.cr].title}}
            </md-tooltip>
        </md-button>

        <input type="text" ng-model="item.ini" placeholder="{{item.title}}" ng-if="item.type == 'text'">

        <div ng-if="item.type == 'date'" ng-init="item.when = 1" class="date-filter-item">
            <input type="text" ng-model="item.ini" placeholder="{{item.title}}"
                   ng-jalaali-flat-datepicker
                   datepicker-config="{dateFormat:'jYYYY/jMM/jDD',allowFuture:true}"
            >
            <span class="when-filter-date" ng-if="item.when == 1"
                  ng-click="<% $ngTable %>.filter.when(item)">بعد از</span>
            <span class="when-filter-date" ng-if="item.when == 2"
                  ng-click="<% $ngTable %>.filter.when(item)">قبل از</span>
            <span class="when-filter-date" ng-if="item.when == 3"
                  ng-click="<% $ngTable %>.filter.when(item)">برابر باشد</span>
        </div>


        <div ng-if="item.type == 'number'" ng-init="item.when = 1" class="date-filter-item">
            <input type="text" ng-model="item.ini" placeholder="{{item.title}}">
            <span class="when-filter-date" ng-if="item.when == 1"
                  ng-click="<% $ngTable %>.filter.when(item)">بیشتر از</span>
            <span class="when-filter-date" ng-if="item.when == 2"
                  ng-click="<% $ngTable %>.filter.when(item)">کمتر از</span>
            <span class="when-filter-date" ng-if="item.when == 3"
                  ng-click="<% $ngTable %>.filter.when(item)">برابر </span>
        </div>
        <md-switch ng-model="item.ini" class="md-warn" ng-if="item.type == 'switch'"></md-switch>

        <md-select ng-model="item.ini" class="md-warn" ng-if="item.type == 'select'">
            <md-option ng-repeat="(k,i) in item.select" value="{{k}}">{{i}}</md-option>
        </md-select>
        <span class="destroy-filter" ng-click="<% $ngTable %>.filter.removeItem(item)"> <i
                    class="material-icons md-dark">close</i></span>
        <i ng-if="!$last" class="material-icons md-18 md-dark">more_vert</i>
    </div>
</section>
<div flex></div>
<md-button aria-label="menu" class="md-fab md-mini md-accent" layout="row"
           layout-align="center center" ng-click="<% $ngTable %>.serv()">
    <i class="material-icons md-light">refresh</i>
</md-button>

