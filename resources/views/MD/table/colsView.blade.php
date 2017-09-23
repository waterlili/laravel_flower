<?php $_first_row = FALSE; ?>
@foreach($ngCols as $key=>$val)
    @if(!isset($val['const']))
        @if($_first_row)
            <i class="material-icons md-18 md-dark ml-md mr-md">more_vert</i>
        @endif
        <md-checkbox ng-model="<% $ngTable %>.cols.<% $key %>" class="md-primary m-n"
                     aria-label="<% $val['data-title'] %>"
        @if(isset($val['default-view']) && $val['default-view'] == true)
            ng-init="<% $ngTable %>.cols.<% $key %> = true"
                @endif
        >
            <% $val['data-title'] %>
        </md-checkbox>
        <?php $_first_row = true; ?>
    @endif
@endforeach