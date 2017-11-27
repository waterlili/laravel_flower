<div class="ui search" use-search="reg" ng-model="reagent">
    <div class="ui icon input">
        @if(!isset($noLabel))
            <input class="prompt" type="text" placeholder="<% $label %>" ng-model="<% $ngModel %>"
                   ng-required="<% $required or 'false' %>">
        @else
            <input class="prompt" type="text" placeholder="جستجو مشتری" ng-model="cus.search">
        @endif
        <i class="search icon"></i>
    </div>
    <div class="results"></div>
</div>
<div flex></div>
<!--<div>
    <md-button class="md-raised md-primary" ng-disabled="!customer" ng-click="getData()">بررسی صحت کاربری
    </md-button>
</div>-->
