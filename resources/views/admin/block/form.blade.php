<section class="w-box p-md">
    <form name="Form">
        @yield('form')
        @include('MD.Notice.notice' , ['type'=>'info' , 'repeat'=>'submit.infoItem'])
        @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'submit.errorItem'])
        @if(!isset($edt))
            <md-divider class="mv-md"></md-divider>
            <div layout="row" layout-align="start center" class="mt-md">
                @include('MD.button.submit' , ['title'=>"ثبت" , 'submit.submit()'])
                <div layout="row" ng-if="_loading">
                    <md-progress-circular md-diameter="20px"></md-progress-circular>
                    <span>در حال پردازش اطلاعات</span>
                </div>

            </div>
        @endif
    </form>
</section>