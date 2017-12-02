<div class="md-bg md-background md-hue-1 b-shadow-top">
    <div class="cm" layout-gt-md="row">
        <div class="step-bar-wrapper">
            <div class="step-bar" show-gt-md hide></div>
            @for($i = $page+1;$i<=4;++$i)
                <div layout="row" class="step-item" layout-align="start center" layout-padding="">
                    <div class="step-bar-number"><% $i %></div>
                    <strong class="mr-md step-bar-title"><% trans('register.page_'.$i.'_header_title') %></strong>
                </div>
            @endfor
            <div class="step-item" layout="row" layout-align="start center" layout-padding="">
                <div class="step-bar-number md-bg" style="color: white" layout="row" layout-align="center center"><i
                            class="material-icons">&#xE876;</i></div>
                <strong class="md-fg mr-md step-bar-title"><% trans('register.page_5_header_title') %></strong>
            </div>
        </div>
        <div flex></div>
    </div>
</div>