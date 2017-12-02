<section class="w-box mt ng-table-wrapper" use-ng-table ngt-model="<% $ngTable %>"
         ng-init="<% $ngTable %>.ngtRoute = '<% $ngtRoute %>'">
    <div class="header-table" layout-padding layout="row" layout-align="center center">
        <span layout="column" layout-align="start start">
            <span><% $header or ''%></span>
            <span class="md-fg md-tiny-title"
                  ng-if="!<% $ngTable %>.progress">تعداد ردیف های موجود<b>{{<% $ngTable %>.tableParams.total()}}</b></span>
        </span>
        <span flex ng-init="<% $ngTable.'.'.$filter_show %>=<% $ngTable.'.'.$view_show %>=false"></span>
        @if(isset($ngFilter))
            <md-button class="md-icon-button md-primary"
                       ng-class="{'md-raised':<% $ngTable.'.'.$filter_show %>}"
                       ng-click="<% $ngTable.'.'.$filter_show %>=!<% $ngTable.'.'.$filter_show %>"><i
                        class="material-icons md-24 ">filter_list</i></md-button>
        @endif
        <md-button class="md-icon-button md-accent"
                   ng-class="{'md-raised':<% $ngTable.'.'.$view_show %>}"
                   ng-click="<% $ngTable.'.'.$view_show %>=!<% $ngTable.'.'.$view_show %>"><i
                    class="material-icons md-24">remove_red_eye</i></md-button>

        <md-button class="md-icon-button" ng-click="<% $ngTable %>.exportExcel()"><i
                    class="material-icons md-24 md-fg ">insert_drive_file</i>
            <md-tooltip><% trans('md.table.export_excel') %></md-tooltip>
        </md-button>


        <md-button class="md-icon-button " ng-click="<% $ngTable %>.print()"><i
                    class="material-icons md-24" style="color: #009688;">print</i>
            <md-tooltip><% trans('md.table.print') %></md-tooltip>
        </md-button>

        <md-button class="md-icon-button" ng-click="<% $ngTable %>.serv()"><i
                    class="material-icons md-24 md-dark">refresh</i></md-button>
    </div>
    @if(isset($ngFilter))
        <div class="ng-filter-table" layout-gt-md="row" layout-align="start center" layout-padding
             ng-show="<% $ngTable.'.'.$filter_show %>">
            @include('MD.table.filter')

        </div>
        @if(isset($btnFilter))
            <div class="ng-filter-btn-table p-sm" layout-gt-md="row" layout-align="start center"
                 ng-show="<% $ngTable.'.'.$filter_show %>">
                @include('MD.table.button_click' , ['btnFilter'=>$btnFilter])
            </div>
        @endif
    @endif
    <div class="ng-view-table" layout="row" layout-align="start center" layout-wrap layout-padding
         ng-show="<% $ngTable.'.'.$view_show %>">
        @include('MD.table.colsView')
    </div>

    <table ng-table="<% $ngTable %>.tableParams" ng-show="<% $ngTable %>.tableParams.data">
        <tr
                @if(isset($extraRow))
                ng-repeat-start="row in $data"
                @else
                ng-repeat="row in $data"
                @endif
        >
            @foreach($ngCols as $key=>$val)
                <td data-title="'<% $val['data-title'] or '' %>'"
                    @if(isset($val['sort']))
                    sortable="<% $val['sort'] %>"
                    @endif
                    @if(isset($val['filter']))
                    filter="<% $val['filter'] %>"
                    @endif
                    @if(!isset($val['const']))
                    ng-if="<% $ngTable %>.cols.<% $key %>"
                        @endif
                >
                    @if(isset($val['include']))
                        @include($val['include']['link'] , $val['include']['vars'] )
                    @elseif(isset($val['more']))
                        <i ng-if="row.<%$key%>" class="material-icons md-18 md-popover" direction="top"
                           angular-popover template="{{row.<%$key%>}}"
                           style="position: relative;">more_horiz
                        </i>
                    @else
                        @if(isset($val['view_filter']))
                            {{row.<%$key%> | <% $val['view_filter'] %>}}
                        @else
                            {{row.<%$key%>}}
                        @endif
                    @endif
                </td>
            @endforeach
        </tr>
        @if(isset($extraRow))
            <tr ng-repeat-end ng-if="row.extraRow">
                <td colspan="<% sizeof($ngCols) %>" class="extra-row">
                    @include($extraRow['include'] , $extraRow['vars'])
                </td>
            </tr>
        @endif
    </table>

    <div ng-if="<% $ngTable %>.tableParams.data.length == 0 && !<% $ngTable %>.progress" class="w-box red p-md">
        <% trans('md.table.nothing_record') %>
    </div>
    <div class="ng-table-preloader" ng-if="<% $ngTable %>.progress" layout="row" layout-align="center center">
        <md-progress-circular md-mode="indeterminate"></md-progress-circular>
    </div>
</section>


