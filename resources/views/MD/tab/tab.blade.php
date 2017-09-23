<section class="ar-tab w-box">
    <div layout-gt-md="row">
        @foreach($tabs as $item)
            @if(isset($item['rid']))
                @can('access' , $item['rid'])
                <a class="m-n tab-btn ph-md pv-sm md-fg md-warn." md-ink-ripple ui-sref-active="md-active md-warn"
                   ui-sref="<% $item['sref'] %>"><% $item['title'] %></a>
                @endcan
            @else
                <a class="m-n tab-btn ph-md pv-sm md-fg md-warn." md-ink-ripple ui-sref-active="md-active md-warn"
                   ui-sref="<% $item['sref'] %>"><% $item['title'] %></a>
            @endif
        @endforeach
        @if(isset($repeat))
            <a ng-repeat="item in <% $repeat %>" class="m-n tab-btn ph-md pv-sm md-fg md-warn" md-ink-ripple
               ui-sref-active="md-active md-warn"
               ui-sref="{{item.sref}}">{{item.title}}</a>
        @endif
    </div>
    <md-divider></md-divider>
    <div ui-view="viewTab" class="p-sm ">

    </div>
</section>