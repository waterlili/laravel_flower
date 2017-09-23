<div ui-tree>
    <ol ui-tree-nodes="" ng-model="<% $model %>">
        <li ng-repeat="item in <% $model %>" ui-tree-node collapsed="item.col">
            <div ui-tree-handle layout="row" layout-align="start center" class="tree-item">
                <md-button ng-click="toggle(this)" class="md-icon-button md-primary" data-nodrag>
                    <i class="material-icons md-18">keyboard_arrow_down</i>
                </md-button>
                <div class="md-fg" layout="column">
                    <span>{{item.title}}</span>
                    <i class="md-tiny-title" style="font-weight: normal">{{item.url}}</i>
                </div>
                <spna flex></spna>
                <md-button ng-click="remove(this)" class="md-icon-button md-warn" data-nodrag>
                    <i class="material-icons md-18">close</i>
                </md-button>
            </div>
            <ol ui-tree-nodes="" ng-model="item.items" ng-class="{'ng-hide':collapsed}">
                <li ng-repeat="subItem in item.items" ui-tree-node>
                    <div ui-tree-handle layout="row" layout-align="start center" class="tree-item">
                        <div class="md-fg" layout="column">
                            <span>{{item.title}}</span>
                            <i class="md-tiny-title" style="font-weight: normal">{{item.url}}</i>
                        </div>
                        <spna flex></spna>
                        <md-button ng-click="remove(this)" class="md-icon-button md-warn" data-nodrag>
                            <i class="material-icons md-18">close</i>
                        </md-button>
                    </div>
                </li>
            </ol>
        </li>
    </ol>
</div>