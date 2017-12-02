<section class="w-box tac <% $color or 'gray' %>" layout="row" layout-align="center stretch" layout-fill>
    <div flex="60" layout-padding class="left-color-box" layout="column" layout-align="center center">
        <h4 class="h4"><% $title or 'بدون عنوان' %></h4>
        <h1 class="h1 mt"><% $value %></h1>
    </div>
    <div flex="40" layout-padding class="right-color-box" layout-align="center center" layout="column">
        <i class="material-icons md-48"><% $icon or 'data_usage' %></i>
    </div>
</section>