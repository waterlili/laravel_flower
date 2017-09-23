<div use-chart-js ng-model="<% $ngModel %>" link="<% $link %>">
    <canvas class="chart chart-<% $type %>"
            @if(isset($w))
            width="<% $w %>"
            @endif
            @if(isset($h))
            height="<% $h %>"
            @endif
            chart-data="<% $ngModel %>.data"
            chart-labels="<% $ngModel %>.labels"
            chart-series="<% $ngModel %>.series"
            chart-options="<% $ngModel %>.options"
            chart-colors="<% $ngModel %>.colors"
    >
    </canvas>
</div>