<div class="input-cnt p-sm" date-inp  ng-model="<% $model %>" ng-data="<% $data_model %>">
    <label
            @if(isset($required))
            ng-init="<% $data_model %>.setRequired()"
            @endif
            ng-class="
            {'md-fg md-warn':true ,
             'md-required':<% $data_model %>.required}"

    ><% trans('register.birth_date') %></label>
    <div layout="row" class="mt-md">
        <md-input-container flex-gt-md="25" class="ml-md-md mt-n">
            <label> <% trans('register.day') %></label>
            <md-select ng-model="<% $model %>.day" ng-required="true">
                <md-option ng-repeat="item in <% $data_model %>.days" value="{{item}}">
                    {{item}}
                </md-option>
            </md-select>
        </md-input-container>
        <md-input-container flex-gt-md="50" class="ml-md-md mt-n">
            <label> <% trans('register.month') %></label>
            <md-select ng-model="<% $model %>.month" ng-required="true">
                <md-option ng-repeat="(key,item) in <% $data_model %>.months" value="{{key}}">
                    {{item}}
                </md-option>
            </md-select>
        </md-input-container>
        <md-input-container flex-gt-md="25" class="ml-md-md  mt-n">
            <label> <% trans('register.year') %></label>
            <md-select ng-model="<% $model %>.year" ng-required="true">
                <md-option ng-repeat="item in <% $data_model %>.years" value="{{item}}">
                    {{item}}
                </md-option>
            </md-select>
        </md-input-container>
    </div>
</div>