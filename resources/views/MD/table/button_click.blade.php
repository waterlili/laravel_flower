<div>
    @foreach($btnFilter as $id=>$title)
        <md-button class="m-n md-fg md-accent" ng-class="{'md-raised':<% $ngTable %>.isActiveBtnFilter('<% $id %>')}"
                   ng-click="<% $ngTable %>.toggleBtnFilter('<% $id %>')"><% $title %></md-button>
    @endforeach
</div>