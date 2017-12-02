<div class="input-cnt mt-md" use-file-upload file-upload-link="console/manage/user-upload-file" ng-model="<% $model %>">
    <h3 class="md-fg p-sm <% $class_color %>"><% $top_title %></h3>
    <md-divider></md-divider>
    <div layout-gt-md="row" layout-align="start center" ng-init="<% $model %>.init()">
        <md-button class="md-raised <% $class_color %>" ngf-select ng-model="<% $model %>.file"
                   name="<% $name %>"
                   ngf-pattern="<% $accept %>"
                   ngf-accept="<% $accept %>"
                   ngf-max-size="<% $max_size %>"
                   ng-disabled="<% $model %>.success || <% $model %>.uploading"
        >
            <% $title %>
        </md-button>
        <span flex></span>
        <md-button class="md-raised <% $class_color %>" ng-click="<% $model %>.__submit()"
                   ng-disabled="!<% $model %>.file || <% $model %>.uploading">بارگذاری
        </md-button>

    </div>
    <div class="ph-sm"
         ng-show="FONE.<% $name %>.$error.maxSize">@include('register.block.notice' , ['text'=>trans('register.max_size_file' , ['max'=>$max_size]),'type'=>'error'])</div>
    <div class="ph-sm"
         ng-show="FONE.<% $name %>.$error.pattern">@include('register.block.notice' , ['text'=>trans('register.pattern_file' , ['type'=>$types]),'type'=>'error'])</div>
    <div class="ph-sm"
         ng-show="<% $model %>.file && !<% $model %>.uploading">@include('register.block.notice' , ['text'=>trans('register.ready_upload'),'type'=>'info'])</div>

    <div class="ph-sm"
         ng-show="<% $model %>.success">@include('register.block.notice' , ['text'=>trans('register.success_upload'),'type'=>'info'])</div>

    <div class="ph-sm"
         ng-show="<% $model %>.uploading">@include('register.block.notice' , ['text'=>'در حال بارگذاری فایل، لطفا تا تکمیل بارگذاری مرورگر خود را در همین وضعیت نگاه دارید.','type'=>'info'])</div>

    <div class="ph-sm"
         ng-show="<% $model %>.errorUploading">@include('register.block.notice' , ['text'=>trans('register.error_upload'),'type'=>'error'])</div>
    <p ng-if="!<% $model %>.progress" class="m-n p-sm" style="color: grey;font-size: 0.9em"><i
                class="material-icons md-18 ml-sm text-warning">&#xE002;</i> <% $top_description %></p>
    <md-progress-linear class="<% $class_color %>" ng-if="<% $model %>.progress" md-mode="determinate"
                        value="{{<% $model %>.progress}}"></md-progress-linear>
</div>