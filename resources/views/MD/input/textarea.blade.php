<div class="mb-xl" style="width: 100%">

        <textarea placeholder="<% $label%>" class="txt-tyle"
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
    /></textarea>

    @if(isset($formName))
        <div ng-messages="<% $formName.'.'.$name %>.$error" role="alert"
             style="position: absolute;    margin: 5px 20px;">
            @if(isset($ngMessage))
                @foreach($ngMessage as $item)
                    <div ng-message="<% $item['ngMessage'] %>" class="ui label red"><% $item['text'] %></div>
                @endforeach
            @endif
        </div>
    @endif
</div>