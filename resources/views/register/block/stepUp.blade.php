<div class="md-bg md-background b-shadow-top" style="background-color: rgb(243, 254, 255);">
    <div class="cm" layout-gt-md="row">
        <div class="step-bar-wrapper">
            <div class="step-bar" show-gt-md hide></div>
            @for($i = 1;$i<$page;++$i)
                <div class="step-item" layout="row" layout-align="start center" layout-padding="">
                    <div class="step-bar-number md-bg" style="color: white" layout="row" layout-align="center center"><i
                                class="material-icons">&#xE876;</i></div>
                    <strong class="md-fg mr-md step-bar-title"><% trans('register.page_'.$i.'_header_title') %></strong>
                </div>
            @endfor
        </div>
        <div flex></div>
    </div>
</div>