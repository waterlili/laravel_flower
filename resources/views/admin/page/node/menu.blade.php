<?php
$title_menu = new \App\View\InputObject('data.title', trans('field.title'));
$title_menu->setRequired(true);
$title_menu->hasMessage('add' , 'title');
$url = new \App\View\InputObject('data.url', trans('field.url'));
$url->setRequired(true);
$url->hasMessage('add' ,'url');

?>
<h3 class="b p-md w-box"><% trans('subject.menus') %></h3>

<md-divider class="mv-md"></md-divider>
<div class="w-box p-md mb-md" layout-gt-md="row">
    <md-input-container flex-gt-md="33">
        <label><% trans('subject.select_menu') %></label>
        <md-select ng-model="menu">
            <md-option value="1"><% trans('subject.header') %></md-option>
            <md-option value="2"><% trans('subject.footer_col_1') %></md-option>
            <md-option value="3"><% trans('subject.footer_col_2') %></md-option>
            <md-option value="4"><% trans('subject.footer_col_3') %></md-option>
            <md-option value="5"><% trans('subject.footer_col_4') %></md-option>
        </md-select>
    </md-input-container>
</div>
<div ng-if="menu">
    <div class="w-box p-md">
        <form name="add">
            <div layout-gt-md="row" layout-align="start center">
                <div flex-gt-md="33" class="ml-md-md">
                    @include('MD.input.text' , $title_menu->export())
                </div>
                <div flex-gt-md="33" class="ml-md-md">
                    @include('MD.input.text' , $url->export())
                </div>
                <div flex-gt-md="33">
                    @include('MD.button.submit' , ['title'=>'add' , 'form'=>'add' , 'submit'=>'addMenu()'])
                </div>
            </div>
        </form>
    </div>
    @include('MD.tree.expand' , ['model'=>'list'])
    <md-divider class="mv-md"></md-divider>
    @include('MD.button.submit')
</div>