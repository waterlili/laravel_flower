<section id="profile-menu" layout="column">
    <div class="tac mv-md" id="profile-content" layout-gt-md="row" layout-align-gt-md="start center">
        <div class="image-thumb small">
            @if(is_null(Auth::user()->personal_picture))
                <img src="<% url('img/male-profile.png') %>">
            @else
                <img src="<% url(Auth::user()->personal_picture).'?'.\Carbon\Carbon::now()->timestamp%>">
            @endif
        </div>
        <div class="ph-md">
            <h3 class="md-fg md-background tac"><% Auth::user()->fname .' '.Auth::user()->lname %></h3>
            <h6 class="text-muted tac"><% Auth::user()->email %></h6>
        </div>

    </div>
    <div layout="row" layout-align="space-around center" style="position: relative;z-index: 2;">
        <div>
            <md-button class="md-icon-button" flex href="<% url('auth/logout') %>">
                <md-tooltip md-direction="bottom">خروج از سیستم</md-tooltip>
                <i class="material-icons md-light md-18">power_settings_new</i></md-button>
        </div>
        <div>
            <md-button class="md-icon-button" flex ui-sref="consoleprofilesettings">
                <md-tooltip md-direction="bottom">کاربری</md-tooltip>
                <i class="material-icons md-light md-18">settings</i></md-button>
        </div>
        <div>
            <md-button class="md-icon-button" flex ng-click="toggleRight()">
                <md-tooltip md-direction="bottom">رویداد ها</md-tooltip>
                <i class="material-icons md-light md-18">speaker_notes</i></md-button>
        </div>
    </div>
    <div id="profile-bg-image" style="background-image: url(<% url('img/nav_cover_2.jpg') %>) ; opacity: 0.6"></div>
    <md-divider></md-divider>
</section>