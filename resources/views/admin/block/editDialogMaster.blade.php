<md-dialog aria-label="Edit Dialog" style="position:relative;">
    <form ng-cloak>
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>@yield('title' , trans('subject.edit_dialog'))</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content>
            <div class="md-dialog-content">
                @yield('content')
            </div>
        </md-dialog-content>

        @if(!isset($noBtn))
            <md-dialog-actions layout="row">
                @yield('action')
                <span flex></span>
                <md-button ng-click="editBtnDialog()" class="md-primary md-raised">
ویرایش
                </md-button>
                <md-button ng-click="cancel()" class="md-warn md-raised">
                انصراف
                </md-button>
            </md-dialog-actions>
        @endif
    </form>
    <div class="dialog-mode-preloader" ng-if="preloader">
        <md-progress-circular md-mode="indeterminate" class="md-accent"></md-progress-circular>
    </div>
</md-dialog>