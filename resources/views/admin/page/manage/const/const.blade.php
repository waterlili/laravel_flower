<section>
    <div class="w-box p-md mh-md">
        <div layout-gt-md="row" layout-align="start start" class="mt-md">

            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'color' , 'title'=>'رنگ' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'color.errorItems'])

        </div>
        <div layout-gt-md="row" layout-align="start start" class="mt-md">

            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'flower' , 'title'=>'گل' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'flower.errorItems'])

        </div>
        <div layout-gt-md="row" layout-align="start start" class="mt-md">

            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'attraction' , 'title'=>'نحوه جذب' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'attraction.errorItems'])

        </div>
        <div layout-gt-md="row" layout-align="start start" class="mt-md">

            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'job' , 'title'=>'رسته شغلی' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'job.errorItems'])

        </div>
        <div layout-gt-md="row" layout-align="start start" class="mt-md">

            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'skill' , 'title'=>'مهارت' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'skill.errorItems'])

        </div>
        <div layout-gt-md="row" layout-align="start start" class="mt-md">

            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'packet_type' , 'title'=>'نوع بسته'])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'packet_type.errorItems'])

        </div>
    </div>

</section>