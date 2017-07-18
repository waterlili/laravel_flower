
<div class="mb-xxl">
    <div class="ui selection dropdown" use-dropdown ng-model="<% $ngModel %>" style="width: 100%">
        <input type="hidden" ng-model="<% $ngModel %>" name="<% $name %>">
        <i class="dropdown icon"></i>
        <div class="default text"><% $label %></div>
        <div class="menu">
            @foreach($items as $key=>$item)
                <div class="item"  data-value="<% $key %>"><% $item %></div>
            @endforeach
        </div>
    </div>
    @if(isset($formName))
        <div ng-messages="<% $formName.'.'.$name %>.$error" role="alert" style="position: absolute  ;  margin: 5px 20px;">
            @if(isset($ngMessage))
                @foreach($ngMessage as $item)
                    <div ng-message="<% $item['ngMessage'] %>"><% $item['text'] %></div>
                @endforeach
            @endif
        </div>
    @endif

</div>