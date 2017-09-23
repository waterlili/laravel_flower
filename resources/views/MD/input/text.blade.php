<md-input-container>
    @if(!isset($noLabel))
        <label
                @if(isset($required))
                class="md-required"
                @endif

        ><% $label %></label>
    @endif
    <input
            type="<% $type %>"
            ng-model="<% $ngModel %>"
            @if(isset($required))
            ng-required="<% $required or 'false' %>"
    @endif
    <% (isset($pattern))?"ng-pattern=$pattern":'' %>
    <% (isset($inpAttr))?join(' ' , $inpAttr):'' %>
    <% (isset($name))?"name=$name":'' %>
    <% (isset($_min))?"md-minlength=$_min":'' %>
    <% (isset($_max))?"md-maxlength=$_max":'' %>
    >
    @if(isset($formName))
        <div ng-messages="<% $formName.'.'.$name %>.$error" role="alert">
            @if(isset($ngMessage))
                @foreach($ngMessage as $item)
                    <div ng-message="<% $item['ngMessage'] %>"><% $item['text'] %></div>
                @endforeach
            @endif
        </div>
    @endif
</md-input-container>
