<md-input-container class="md-block">
    @if(!isset($noLabel))
        <label><% $label %></label>
        @if($ngModel=='data.phone' || $ngModel=='data.phone2')
            <md-icon><i class="material-icons">settings_phone</i></md-icon>
        @elseif($ngModel=='data.mobile')
            <md-icon><i class="material-icons">smartphone</i></md-icon>
        @elseif($ngModel=='data.email')
            <md-icon><i class="material-icons">email</i></md-icon>
        @endif
    @endif

    <input type="<% $type %>"
           ng-model="<% $ngModel %>"
           @if(isset($required))
           ng-required="<% $required or 'false' %>"
           md-no-asterisk
    @endif
    <% (isset($pattern))?"ng-pattern=$pattern":'' %>
    <% (isset($inpAttr))?join(' ' , $inpAttr):'' %>
    <% (isset($name))?"name=$name":'' %>
    <% (isset($_min))?"md-minlength=$_min":'' %>
    <% (isset($_max))?"md-maxlength=$_max":'' %>

    >


    <div ng-messages="projectForm.description.$error">
        <div ng-message="required">پر کردن فیلد الزامی است</div>
    </div>
</md-input-container>
