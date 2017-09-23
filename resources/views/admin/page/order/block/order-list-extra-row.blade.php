<div ng-init="init(row)" class="order-list-extra-row">
    <md-list flex>
        <md-subheader>
            <md-button class="md-primary md-icon-button" ng-click="editProductListDialog($event , row)">
                <i class="material-icons md-18" style="line-height: 70%">mode_edit</i>
                <md-tooltip>ویرایش محصولات</md-tooltip>
            </md-button>
            <span>لیست محصولات فاکتور</span>
        </md-subheader>
        <md-divider></md-divider>
        <div layout="row" layout-align="center center">
            <md-progress-circular md-diameter="25px" ng-if="row.extra_loading"></md-progress-circular>
        </div>
        <md-list-item class="list-item-product" ng-repeat="item in row.order_items">
            <div layout="row" layout-align="start center" style="width: 100%">
                <div class="md-list-item-text" layout="column" flex="50">
                    <h3>{{ item.product_name.title }}</h3>
                    <h4>{{ item.product_name.code }}</h4>
                </div>
                <p flex="25">
                    {{ item.product_name.price | currency:'':'' }}
                    <md-tooltip md-direction="right">مبلغ</md-tooltip>
                </p>
                <p flex="25">
                    {{ item.total}}
                    <md-tooltip md-direction="right">تعداد سفارش</md-tooltip>
                </p>

            </div>
            <md-divider></md-divider>
        </md-list-item>
    </md-list>
</div>
