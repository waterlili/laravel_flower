<md-dialog ng-cloak>
    <form>
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>تعهد نامه</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <i class="material-icons">&#xE5CD;</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content>
            <div class="md-dialog-content">
                متن تعهد نامه
            </div>
        </md-dialog-content>
        <md-dialog-actions layout="row">
            <md-button ng-click="answer(true)" class="md-raised md-warn">
                تعهد می دهم
            </md-button>
            <div flex></div>
            <md-button ng-click="answer('sa')">
                انصراف
            </md-button>
        </md-dialog-actions>
    </form>
</md-dialog>