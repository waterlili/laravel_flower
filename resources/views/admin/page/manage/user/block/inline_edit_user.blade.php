<?php
$fname = new \App\View\InputObject('data.fname', trans('field.fname'));
$lname = new \App\View\InputObject('data.lname', trans('field.lname'));
$email = new \App\View\InputObject('data.email', trans('field.email'));
$username = new \App\View\InputObject('data.username', trans('field.username'));
$fname->setRequired('true');
$lname->setRequired('true');
$email->setRequired('true');
$username->setRequired('true');
?>

<div layout-gt-md="row" layout-align="start start" class="p-md">
    <div flex-gt-md="25">
        @include('MD.input.text' , $fname->export())
        @include('MD.input.text' , $lname->export())
    </div>
    <div flex-gt-md="25">
        @include('MD.input.text' , $email->export())
        @include('MD.input.text' , $username->export())
    </div>
    <div flex-gt-md="25">
        <md-input-container>
            <label><% trans('field.type') %></label>
            <md-select ng-model="data.type">
                @foreach(\App\DB\User::$TYPES as $key=>$item)
                    <md-option value="<% $key %>">
                        <% $item %>
                    </md-option>
                @endforeach
            </md-select>
        </md-input-container>
    </div>
    <div flex-gt-md="25">

    </div>
</div>