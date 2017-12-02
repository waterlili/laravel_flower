<html>
<head>
    <style>
        body {
            background-image: url("http://185.173.106.234/img/payments.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
</head>
<body>
<div>
    @if(!empty($refID))
        <div class="pym_re success">
        <p>پرداخت شما با موفقیت انجام شد</p>
        <p>{{ $refID }}:شماره مرجع</p></p>
    </div>
    @elseif(!empty($status))
        <div class="pym_re alert">
            <p>پرداخت ناموفق</p>

        </div>
    @endif
</div>
</body>
</html>
