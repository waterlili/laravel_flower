<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>گلسافت ؛؛ خروجی چاپی</title>
    <link rel="stylesheet" href="<% url('css/print.css') %>">
</head>
<body>
<section class="cm">
    <div class="input-cnt p-md mb-md">
        <h3 style="25px">گلسفات</h3>
        <hr>
        <span><span>تاریخ گزارش : </span><b>
                <?php echo \Morilog\Jalali\jDate::forge()->format('Y/n/j-H:i', true) ?>
            </b></span>
    </div>
    <h3 class="b"><% $title %></h3>
    <hr>
    <table class="table-print">
        <thead>
        <tr>
            @if(sizeof($record) !=0)
                @foreach($record[0] as $key=>$item)
                    <th><% trans('cols.'.$key) %></th>
                @endforeach
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($record as $key=>$item)
            <tr>
                @foreach($cols as $val)
                    <td><% array_get($item , $val) %></td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <div class="tac">
        <span>این گزارش توسط </span>
        <span> <% \Illuminate\Support\Facades\Auth::user()->fname." " .\Illuminate\Support\Facades\Auth::user()->lname %></span>
        <span>گرفته شده است.</span>
    </div>
</section>
<script>
    window.print();
</script>
</body>
</html>
