<div class="mp mb-md" id="tpc-bk" layout-gt-md="row" layout-align="center center" flex>
    <div flex-gt-md="50" class="mh-sm" align="center">
        عنوان ترکیب
    </div>
    <div flex-gt-md="50" class="mh-sm" align="center">
        برگ
    </div>
</div>
<div class="mv-md mb-md" layout-gt-md="row">
    <div flex-gt-md="50" class="mh-sm" align="center">
        {{ data.name }}
    </div>
    <div flex-gt-md="50" class="mh-sm" align="center">
        {{ data.leaf_str }}
    </div>
</div>

<div class="mv-md mb-md" layout-gt-md="row" ng-hide="data.flower==''">
    <ul>
        <li ng-repeat="flower in data.flower">
            {{ flower.pivot.count }}&nbsp;{{ flower.vahed == 'shakhe' ? 'شاخه' : 'ساقه' }}&nbsp;{{ flower.name }}
        </li>
    </ul>
</div>

<div class="mv-md mb-md" layout-gt-md="row" ng-hide="data.combination_flowers==''">
    <table>
        <thead>
        <tr>
            <th>ترکیبات</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="item in data.combination_flowers">
            <td>{{item}}</td>
        </tr>
        </tbody>
    </table>
</div>

