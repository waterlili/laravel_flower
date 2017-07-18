<div layout-gt-md="row">
    <md-list flex-gt-md="33" class="w-box">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>آخرین ورودی ها به سامانه</h2>
            </div>
        </md-toolbar>
        @foreach($log as $item)
            <md-list-item class="md-priamry">
                <div class="tar p-md">
                    <h4 class="md-fg md-primary b">@include('register.block.itemShow' , ['field'=>'آی پی'  , 'value'=>'127.0.0.1'])</h4>
                    @include('register.block.itemShow' , ['field'=>'تاریخ ورود'  , 'value'=>$item->created_at_j])
                </div>
            </md-list-item>
            <md-divider></md-divider>
        @endforeach
    </md-list>
</div>