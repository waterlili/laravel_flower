<md-button class="md-raised md-primary" ng-click="<% $submit or 'submit()' %>" ng-disabled="<% $form or 'Form' %>.$invalid">
    @if(isset($title))
        <% $title %>
    @else
        <% trans('field.submit') %>
    @endif
</md-button>