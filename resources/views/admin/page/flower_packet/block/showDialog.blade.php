<div class="mv-md mb-md" layout-gt-md="row">
    <div flex-gt-md="100" class="mh-sm bg-flex-even">
        <span>نام بسته </span><span class="flex-pos">{{ data.name }}</span>
    </div>
    <div flex-gt-md="100" class="mh-sm bg-flex-odd">
        <span>نوع بسته </span><span class="flex-pos">{{ data.type_str }}</span>
    </div>
</div>
<div class="mv-md mb-md" layout-gt-md="row">
    <table>
        <thead>
        <tr>
            <th style="background-color: #689F38;color:#fffffa">ترکیبات</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="item in data.packages">
            <td ng-if="$odd" style="background-color:#DFF0D8">
                {{item.name}}</td>
            <td ng-if="$even">
                {{item.name}}</td>
        </tr>
        </tbody>
    </table>
</div>
