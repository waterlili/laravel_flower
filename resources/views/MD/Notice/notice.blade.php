<?php
$icon = '&#xE002;';
switch ($type) {
    case 'info':
        $icon = '&#xE88E;';
        break;
    case 'error':
        $icon = '&#xE5C9;';
        break;
}
?>
@if(isset($repeat))
    <div ng-repeat="item in <% $repeat %>" class="mv-md notice notice-<% $type %>"><i
                class="material-icons"><% $icon %></i> <span>{{item[0]}}</span>
    </div>
@else
    <div class="mv-md notice notice-<% $type %>"><i class="material-icons"><% $icon %></i> <span><% $text %></span>
    </div>
@endif