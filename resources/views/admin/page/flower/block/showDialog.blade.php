<div class="mv-md mb-md" layout-gt-md="row">
    <div flex-gt-md="50" class="mh-sm">
        {{ data.name }} -
        {{ data.nemad }}
    </div>
    <div flex-gt-md="50" class="mh-sm">
    </div>
</div>
<div class="mv-md mb-md" layout-gt-md="row">
    <div flex-gt-md="100" class="mh-sm">
        واحد:{{ data.vahed_str }}
        -
        قیمت واحد: {{ data.price }}
        -
        بو:{{ data.has_boo | iif:"دارد":"ندارد"}}
        -
        ساقه: {{ data.saghe_str }}
        -
        ماندگاری: {{ data.mandegari_str }}
        -
        رده قیمتی: {{ data.rade_str }}
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
