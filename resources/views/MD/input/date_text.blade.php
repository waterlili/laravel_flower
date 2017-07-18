<div layout="row" style="direction: ltr" class="tal">
    <md-input-container flex="66">
        <label for=""><% trans('field.date') %></label>
        <input ng-model="<% $model %>.date" name="<% $name %>_date" type="text"
               pattern="(?:13|14|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))">
        <div ng-messages="<% $form or 'Form' %>.<% $name %>_date.$error" role="alert">
            <div ng-message="pattern" class="my-message">
                تاریخ وارد شده اشتباه است.
            </div>
        </div>
    </md-input-container>
    @if(!(isset($noTime) && $noTime))
        <md-input-container flex="33">
            <label for=""><% trans('field.time') %></label>
            <input ng-model="<% $model %>.time" name="<% $name %>_time" type="text"
                   pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])">
            <div ng-messages="<% $form or 'Form' %>.<% $name %>_time.$error" role="alert">
                <div ng-message="pattern" class="my-message">
زمان وارد شده اشتباه است
                </div>
            </div>
        </md-input-container>
    @endif
</div>