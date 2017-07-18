<div id="menu-sidebar-wrapper">
    @foreach(\App\Http\UiRoute::get_routes() as $key=>$item)
        @can('access',$item['rid'])
        <div class="menu-item-wrapper">
            @if($item['type'] == 'menu')
                <a md-ink-ripple flex layout-fill layout-padding class="menu-item"
                   style="display: block"
                   href="#/<% $item['ui_url'] %>"><i
                            class="material-icons md-18"><% $item['icon'] %></i>
                    <span class="ml-sm"><% $item['title'] %></span>
                </a>
            @elseif($item['type'] == 'group')
                <div class="menu-item-wrapper" ng-init=""
                     ng-class="{'active':active_menu=='<% $item['id'] %>'}">
                    <div md-ink-ripple layout="row"
                         ng-click="set_active_menu('<% $item['id'] %>' , $event)"
                         layout-align="start center"
                         class="menu-item p-sm"
                         ng-class="{'active':active_menu=='<% $item['id'] %>'}">
                        <div><i class="material-icons md-18"><% $item['icon'] %></i></div>
                        <div><span class="ml-sm"><% $item['title'] %></span></div>
                        <div flex></div>
                        <div><i class="material-icons arrow_left md-18">keyboard_arrow_left</i></div>
                    </div>
                    @if(isset($item['items'] ))
                        <ul class="menu-item-wrapper-inner">
                            @foreach($item['items'] as $key_2=>$item_in)
                                @can('access' , $item_in['rid'])
                                <li><a md-ink-ripple flex layout-padding class="menu-item inner" layout="row"
                                       layout-align="center center"
                                       ui-sref-active="salam"
                                       href="#/<% $item_in['ui_url'] %>"><span flex><% $item_in['title'] %></span>
                                        @if(isset($item_in['notify']))
                                            <span flex></span> <span
                                                    class="circle-notify-menu"><% $item_in['notify'] %></span>
                                        @endif
                                    </a></li>
                                @endcan
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
        </div>
        @endcan
    @endforeach
</div>