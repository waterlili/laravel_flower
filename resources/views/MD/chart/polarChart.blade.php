<canvas class="chart-pie"
        @if(isset($w))
        width="<% $w %>"
        @endif
        @if(isset($h))
        height="<% $h %>"
        @endif
        chart-options="<% $ngModel %>.options"
        chart-data="<% $ngModel %>.data"
        chart-series="<% $ngModel %>.series"
        chart-labels="<% $ngModel %>.labels"
        chart-colors="<% $ngModel %>.colors"
        chart-dataset-override="<% $ngModel %>.datasetOverride">
</canvas>