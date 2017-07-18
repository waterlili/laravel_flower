<div class="step-item" layout="row" layout-align="start center" layout-padding="">
    <div class="step-bar-number md-bg"
         @if(isset($hasTick))
         style="color: white"
         @endif
         layout="row" layout-align="center center">
        @if(isset($hasTick))
            <i class="material-icons">&#xE876;</i>
        @endif
    </div>
    <strong class=" mr-md step-bar-title <% isset($hasTick)?'md-fg':'' %>"><% $title %></strong>
</div>