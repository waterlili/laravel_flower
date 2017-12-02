@if(isset($fset))
    <fieldset>
        <legend><% $fset %></legend>
        @endif
        <md-radio-group ng-model="<% $ngModel %>">
            @foreach($items as $key=>$item)
                <md-radio-button value="<% $key %>"><% $item %></md-radio-button>
            @endforeach
        </md-radio-group>
        @if(isset($fset))
    </fieldset>
@endif