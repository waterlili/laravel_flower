<div ng-controller="AttractionCtrl as ctrl" layout="column" ng-cloak>
    <md-content class="md-padding" id="md-bg">

        <md-autocomplete class="selection"
                         ng-model="<% $ngModel %>"
                         name="<% $name %>"
                         ng-disabled="ctrl.isDisabled"
                         md-no-cache="true"
                         md-selected-item="ctrl.selectedItem"
                         md-search-text-change="ctrl.searchTextChange(ctrl.searchText)"
                         md-search-text="ctrl.searchText"
                         md-selected-item-change="ctrl.selectedItemChange(item)"
                         md-items="item in ctrl.querySearch(ctrl.searchText)"
                         md-item-text="item.title"
                         md-min-length="0"
                         placeholder=<% $label %>>
            <md-item-template>
                <span md-highlight-text="ctrl.searchText" md-highlight-flags="^i">{{item.title}}</span>
            </md-item-template>
            <md-not-found>
                No states matching "{{ctrl.searchText}}" were found.
                <a ng-click="ctrl.newState(ctrl.searchText)">Create a new one!</a>
            </md-not-found>
        </md-autocomplete>
        <br/>

    </md-content>
</div>
