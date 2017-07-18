<section class="w-box p-md">
    <h3 class="b md-fg md-accent">قوانین دسترسی</h3>
    <md-divider class="mv-md"></md-divider>
    <div layout-gt-md="row" layout-align="start center">
        <div flex-gt-md="33">
            <md-input-container>
                <label>نوع کاربری</label>
                <md-select ng-model="data.user_type">
                    @foreach(\App\DB\User::$TYPES as $key=>$item)
                        <md-option value="<% $key %>"><% trans($item) %></md-option>
                    @endforeach
                </md-select>
            </md-input-container>
        </div>
    </div>
    <md-divider class="mv-md"></md-divider>
    <div layout="column" ng-show="data.user_type && !loading">
        <collection collection='data.roles'></collection>
    </div>
    <div ng-show="loading">
        <md-progress-linear></md-progress-linear>
    </div>
    <md-divider class="pc-md mv-md"></md-divider>
    <div>
        <md-button class="md-raised md-primary" ng-click="submit()">ذخیره قوانین</md-button>
    </div>
</section>