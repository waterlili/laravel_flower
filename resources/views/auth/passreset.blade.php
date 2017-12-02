<section class="admin_section p-m">تغییر رمز عبور</section>

<section layout-gt-md="row">
    <div flex-gt-md="50" >
        <div class="admin_section p-m">
            <form method="POST" name="pass_form">
                <input type="hidden" ng-model="data._token" name="_token" value="<% csrf_token() %>"/>
                <md-input-container>
                    <label>رمز عبور فعلی</label>
                    <input type="password" ng-model="pass.old" name="old"
                           ng-required="true">
                </md-input-container>

                <md-input-container>
                    <label>رمز عبور جدید</label>
                    <input type="password" name="password" ng-model="pass.new" ng-required="true">
                </md-input-container>

                <md-input-container>
                    <label>تکرار رمز عبور جدید</label>
                    <input type="password" name="passconf" ng-model="pass.new2" ng-required="true">
                    <div ng-messages="pass_form.passconf.$error" role="alert">
                        <div ng-message="pass_confirm" class="my-message">مقدار تکرار رمز عبور و رمز عبور یکسان نیست</div>
                    </div>
                </md-input-container>
                <md-button class="md-raised md-primary" style=";margin: 0;" ng-click="change_pass($event)"
                           ng-disabled="pass_form.$invalid">تغییر رمز عبور
                </md-button>

                <div class="form-seprator p-m"></div>
            </form>
        </div>
    </div>
    <div flex-gt-md="50">
        <div class="admin_section p-m">
            <form method="POST" name="profile_form">
                <input type="hidden" ng-model="data._token" name="_token" value="<% csrf_token() %>"/>
                <md-input-container>
                    <label>نام و نام خانوادگی</label>
                    <input type="text" ng-model="pass.old" name="old"
                           ng-required="true">
                </md-input-container>

                <md-input-container>
                    <label>رمز عبور جدید</label>
                    <input type="password" name="password" ng-model="pass.new" ng-required="true">
                </md-input-container>

                <md-input-container>
                    <label>تکرار رمز عبور جدید</label>
                    <input type="password" name="passconf" ng-model="pass.new2" ng-required="true">
                    <div ng-messages="pass_form.passconf.$error" role="alert">
                        <div ng-message="pass_confirm" class="my-message">مقدار تکرار رمز عبور و رمز عبور یکسان نیست</div>
                    </div>
                </md-input-container>
                <md-button class="md-raised md-primary" style=";margin: 0;" ng-click="change_pass($event)"
                           ng-disabled="pass_form.$invalid">تغییر رمز عبور
                </md-button>

                <div class="form-seprator p-m"></div>
            </form>
        </div>
    </div>
</section>