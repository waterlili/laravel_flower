<div class="mv-md mb-md" layout-gt-md="row">
    <div flex-gt-md="100" class="mh-sm">
        <h2>نام بسته: </h2>{{ data.name }}
    </div>
    <div flex-gt-md="100" class="mh-sm">
        <h2>نوع بسته: </h2>{{ data.type_str }}
    </div>
</div>
<div class="mv-md mb-md" layout-gt-md="row">
    <table>
        <thead>
        <tr>
            <th>ترکیبات</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="item in data.packages">
            <td>{{item.name}}</td>
        </tr>
        </tbody>
    </table>
</div>
