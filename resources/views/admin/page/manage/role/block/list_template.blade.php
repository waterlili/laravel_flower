<div>
    <div layout="row" layout-align="start center">
        <md-button ng-click="toggleShow(member)" class="md-icon-button" ng-class="{'md-raised':member.show}"
                   ng-if="member.children" aria-label="Expand">
            <i class="material-icons md-fg md-primary" ng-if="!member.show">add</i>
            <i class="material-icons md-fg md-warn" ng-if="member.show">remove</i>
        </md-button>
        <md-button class="md-icon-button" ng-if="!member.children" ng-disabled="true" aria-label="End">
            <i class="material-icons md-fg md-accent">subdirectory_arrow_left</i>
        </md-button>
        <span class="md-fg md-priamry">
            {{member._address}}
        </span>
        <hr flex/>
        <md-checkbox ng-model="member.has" class="mb-n"></md-checkbox>
    </div>
</div>