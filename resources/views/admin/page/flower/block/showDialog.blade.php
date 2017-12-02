<div class="mp " id="tpc-bk" layout-gt-md="row">
    <div flex-gt-md="50" class="mh-sm">
        {{ data.name }} -
        {{ data.nemad }}
    </div>
    <div flex-gt-md="50" class="mh-sm">
    </div>
</div>
<div class=" mb-md" flex-gt-md="100" layout-gt-md="row" layout="column" layout-align="center center"
     layout-align="center center" style="background-color: #DFF0D8">

    <div layout="column" layout-align="center center" flex-gt-md="20" class="mh-sm" flex>
        واحد
    </div>
    <div layout="column" layout-align="center center" flex-gt-md="20" class="mh-sm" flex>
        قیمت
    </div>
    <div layout="column" layout-align="center center" flex-gt-md="20" class="mh-sm" flex>
        بو
    </div>
    <div layout="column" layout-align="center center" flex-gt-md="40" class="mh-sm" flex>
        ساقه
    </div>
    <div layout="column" layout-align="center center" flex-gt-md="40" class="mh-sm" flex>
        ماندگاری
    </div>

    <div layout="column" layout-align="center center" flex-gt-md="20" class="mh-sm" flex>
        رده
    </div>
</div>
<div class="mv-md mb-md" layout-gt-md="row" layout-align="center center">

    <div flex-gt-md="20" class="mh-sm" flex>
        {{ data.vahed_str }}
    </div>
    <div flex-gt-md="20" class="mh-sm" flex>
        {{ data.price }}
    </div>
    <div flex-gt-md="20" class="mh-sm" flex>
        {{ data.has_boo | iif:"دارد":"ندارد"}}
    </div>
    <div flex-gt-md="40" class="mh-sm" flex>
        {{ data.saghe_str }}
    </div>
    <div flex-gt-md="40" class="mh-sm" flex>
        {{ data.mandegari_str }}
    </div>
    <div flex-gt-md="20" class="mh-sm" flex>
        {{ data.rade_str }}
    </div>
</div>
<div layout-gt-md="row" ng-show="data.variations!=''">
        <br>
        <br>
        تنوع:
        <br>
        <hr>
        <table>
            <thead>
            <tr>
                <th>رنگ</th>
                <th>تصویر</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="item in data.variations" style="text-align: center">
                <td>{{ item.color }}</td>
                <td>{{ item.image }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
