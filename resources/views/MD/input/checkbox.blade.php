@if(isset($has_border))
    <fieldset class="p-md">
        @endif
        <md-input-container>
            <md-checkbox ng-model="<% $ngModel %>">
                <span><% $label %></span>
            </md-checkbox>
        </md-input-container>
        @if(isset($has_border))
    </fieldset>
@endif
