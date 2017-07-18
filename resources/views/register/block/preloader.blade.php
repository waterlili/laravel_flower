<div id="please-wait" ng-show="preloader">
    <div class="item-plzw" layout="row" layout-align="center center"
         ng-show="preloader == 'process'">
        <i class="material-icons md-18 mr-md">&#xE855;</i>
                            <span>
                            در حال پردازش اطلاعات. لطفا شکیبا باشید.
                            </span>
    </div>


    <div class="item-plzw md-fg md-hue-1" layout="row" layout-align="center center"
         ng-show="preloader == 'next'" >

                            <span>
                            در حال انتقال به مرحله بعدی ثبت نام
                            </span>
        <i class="material-icons md-18">&#xE317;</i>
    </div>

    <div class="item-plzw md-fg md-hue-1" layout="row" layout-align="center center"
         ng-show="preloader == 'back'" >

                            <span>
                            در حال انتقال به مرحله قبلی
                            </span>
        <i class="material-icons md-18">&#xE317;</i>
    </div>
</div>