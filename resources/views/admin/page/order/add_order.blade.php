@section('exchange_info')
    <div class="input-cnt p-md m-md">

    </div>
@endsection
<?php
$page = new \App\View\PageGenerator();
$grid = new \App\View\Grid();
$grid->grid(33, 33, 33);
$grid->align('start start');
$from = new \App\View\InputObjectAc('data.from', 'mdAcFrom', 'console/order/get-currency', trans('field.from_fee'));
$to = new \App\View\InputObjectAc('data.to', 'mdAcTo', 'console/order/get-to', trans('field.to_fee'));

$cid = new \App\View\InputObjectAc('data.cid', 'mdAcCid', 'console/order/get-customer', trans('order.customer'));
$iban = new \App\View\InputObjectAc('data.iban', 'mdAcIban', 'console/order/get-iban', trans('order.iban'));

$from_input = new \App\View\InputObject('data.from_value', trans('field.from_value'));

$from_input->setRequired(true)->hasMessage('Form', 'from');
$from_input->setInpAttr('format-as-currency');
$from->setRequired(true);
$to->setRequired(true);

?>

@section('itemDisplayCurrency')
    <div>
        <span class="flag-icon flag-icon-{{item.icon}} flag-icon-squared mr-md lh-2 "></span>
        {{item.value}}
        | <b>{{item.icon | uppercase}}</b>
    </div>
@endsection

@section('from')
    @include('MD.input.autocomplete' , array_merge($from->export() , ['itemDisplayHtml'=>'itemDisplayCurrency']))
    @include('MD.input.text' , $from_input->export())
@endsection

@section('to')
    <div ng-if="data.from.id">
        @include('MD.input.autocomplete' , array_merge($to->export() , ['itemDisplayHtml'=>'itemDisplayCurrency']))
    </div>
    <div ng-if="!data.from.id">@include('MD.Notice.notice' , ['type'=>'warn' , 'text'=>trans('order.please_select_currency')])</div>
@endsection

@section('change_info')
    <div class="input-cnt p-md mh-md" ng-if="exchange">
        <div><% trans('subject.you_send') %> : {{data.from.value}}</div>
        <h3 class="md-fg md-warn"><% trans('subject.you_send') %> : {{data.from_value}}</h3>
        <md-divider class="mv-md"></md-divider>
        <h2 class="md-fg md-primary md-48"><% trans('subject.recipient_gets') %> : {{data.to.value}}</h2>
        <h3 class="md-fg md-primary"><% trans('subject.recipient_gets') %> : {{calc()}}</h3>
    </div>
@endsection


@section('iban_info')
    <fieldset class="m-md">
        <legend><% trans('fee.iban_info') %></legend>
        <div layout-gt-md="row">
            <div flex-gt-md="25">
                <md-radio-group ng-model="data.iban_type">
                    <md-radio-button value="cid" class="md-primary"><% trans('field.from_customer') %></md-radio-button>
                    <md-radio-button value="iban"><% trans('field.from_iban') %></md-radio-button>
                </md-radio-group>
            </div>
            <div flex-gt-md="50" class="ml-md">
                <div ng-if="data.iban_type == 'cid'">
                    @include('MD.input.autocomplete' , $cid->export())
                    <div class="p-sm mt-md input-cnt md-fg md-primary" ng-if="ibanCidInfo">Iban Code : {{ibanCidInfo.iban}}</div>
                </div>
                <div ng-if="data.iban_type == 'iban'">
                    @include('MD.input.autocomplete' , $iban->export())

                </div>
                <input type="hidden" ng-model="hasIban" ng-required="true">
            </div>
        </div>
    </fieldset>
@endsection

@section('order_doc')
    <fieldset class="m-md">
        <legend><% trans('fee.order_document_info') %></legend>
        <div layout-gt-md="row">
            <div flex-gt-md="30">
                <md-input-container>
                    <label><% trans('order.pay_type') %></label>
                    <md-select ng-model="data.pay_type" ng-required="true">
                        @foreach(\App\DB\Order::$proceed as $key=>$item)
                            <md-option value="<% $key %>"><% trans($item) %></md-option>
                        @endforeach
                    </md-select>
                </md-input-container>
            </div>

        </div>
        <div>
            <div ngf-drop ng-model="data.files" ngf-pattern="'image/*,application/pdf'"
                 ngf-multiple="true"
                 class="p-md tac input-cnt drop-box"
                 ngf-drag-over-class="'dragover'">
                <h3 class="md-fg md-accent"><% trans('order.drag_file_here') %></h3>
                <i ng-if="data.files.length">{{data.files.length}} <% trans('order.not_upload') %></i>
                <div>

                </div>
            </div>
            <div ngf-no-file-drop>File Drag/Drop is not supported for this browser</div>
            <md-progress-linear class="md-primary" ng-if="data.fls.progress" md-mode="determinate"
                                value="{{fls.progress}}"></md-progress-linear>
            <div layout-gt-md="row">
                <md-button class="md-raised md-accent m-n mv-md" ngf-select ng-model="data.files" ngf-multiple="true"
                           ngf-pattern="'image/*,application/pdf'"><% trans('order.select_file') %>
                </md-button>
                <span flex></span>
                <md-button class="md-raised md-primary m-n mv-md" ng-click="uploadFiles()"
                           ng-disabled="!data.files.length || data.fls.success || data.fls.uploading"><%
                    trans('order.upload') %>
                </md-button>
            </div>
        </div>
    </fieldset>
@endsection

<?php
$grid->section(0, 'from', true);
$grid->section(1, 'to', true);
$grid->section(2, 'change_info');
$page->addGrid($grid);
$page->section('iban_info');
$page->section('order_doc');
?>


<section class="w-box p-md">
    <?php echo $page->render(); ?>
</section>

