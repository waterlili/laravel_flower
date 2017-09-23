<div class="mv-md mb-md" layout-gt-md="row">
    <div flex-gt-md="100" class="mh-sm">
        {{ data.name }} -
        {{ 'برگ ' + data.leaf_str }}
    </div>
</div>
<div class="mv-md mb-md" layout-gt-md="row">
    <ul>
        <li ng-repeat="flower in data.flower">
            {{ flower.pivot.count }}&nbsp;{{ flower.vahed == 'shakhe' ? 'شاخه' : 'ساقه' }}&nbsp;{{ flower.name }}
        </li>
    </ul>
</div>
<div class="mv-md mb-md" layout-gt-md="row">
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
