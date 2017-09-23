<div use-ac ng-model="<% $ngModel %>" ng-opt="<% $ngOptions %>" ng-link="'<% $ngLink %>'">
    @if(!isset($noLabel))
        <label><% $label %></label>
    @endif
    <md-autocomplete
            ng-disabled="<% $ngOptions %>.isDisabled"
            md-no-cache="<% $ngOptions %>.noCache"
            md-selected-item="<% $ngOptions %>.selectedItem"
            @if(isset($textChangeEvent))
            md-search-text-change="<% $ngOptions %>.searchTextChange(<% $ngOptions %>.searchText)"
            @endif
            md-search-text="<% $ngOptions %>.searchText"
            @if(isset($selectedItemChange))
            md-selected-item-change="<% $ngOptions %>.<% $selectedItemChange %>"
            @endif
            md-items="item in <% $ngOptions %>.querySearch(<% $ngOptions %>.searchText)"
            md-item-text="item.<% $itemDisplay or 'value' %>"
            md-min-length="<% $_min or 0 %>"
            placeholder="<% $label %>">
        <md-item-template>
            @if(isset($itemDisplayHtml))
                @yield($itemDisplayHtml)
            @else
                <span md-highlight-text="<% $ngOptions %>.searchText" md-highlight-flags="^i">

                {{item.<% $itemDisplay or 'value' %>}}

                </span>
            @endif
        </md-item-template>
        <md-not-found>
            <% trans('subject.nothing_found') %>
        </md-not-found>
    </md-autocomplete>
    @if(isset($required))
        <input type="hidden" ng-model="<% $ngOptions %>.selectedItem" required>
    @endif
</div>


