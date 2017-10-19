<html>
<head></head>
<body style="background: black; color: white">
<h1>سامانه بونیتا</h1>
<p></p>
<?php $query = http_build_query(array('aParam' => $data)); ?>
<p><a href="http://185.173.106.234/payment/<?php echo $query; ?>/zarinpal">پرداخت کنید</a></p>

</body>
</html>
