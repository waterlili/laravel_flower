<div use-chip ng-model="<% $ngModel %>" ng-opt="<% $ngOptions %>" ng-link="'<% $ngLink %>'">
    <md-chips ng-model="<% $ngModel %>" md-autocomplete-snap
              md-require-match="true"
              md-on-add="<% $onAdd or '' %>"
              md-on-remove="<% $onRemove or '' %>"
    >
        <md-autocomplete
                md-selected-item="<% $ngOptions %>.selectedItem"
                md-search-text="<% $ngOptions %>.searchText"
                md-items="item in <% $ngOptions %>.querySearch(<% $ngOptions %>.searchText)"
                md-item-text="item.value"
                placeholder="<% $label or '' %>">
            <span md-highlight-text="<% $ngOptions %>.searchText">{{item.value}}</span>
        </md-autocomplete>
        <md-chip-template>
            {{$chip.value}}
        </md-chip-template>
    </md-chips>
</div>

