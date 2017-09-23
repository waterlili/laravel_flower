<div class="mb-xl">
    <div class="ui left labeled input" style="width: 100%">
        @if(!isset($noLabel))
            <div class="ui basic label">
                <% $label %>
            </div>
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
    </div>
    @if(isset($formName))
        <div ng-messages="<% $formName.'.'.$name %>.$error" role="alert" style="position: absolute;    margin: 5px 20px;">
            @if(isset($ngMessage))
                @foreach($ngMessage as $item)
                    <div ng-message="<% $item['ngMessage'] %>" class="ui label red"><% $item['text'] %></div>
                @endforeach
            @endif
        </div>
    @endif
</div>