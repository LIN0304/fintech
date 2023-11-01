<?php

//nwp-cap.php
//請退款API

include "merc.php";
//變數區
$mon="MyOrder1698820206"; //訂單編號
$amt="30"; //訂單金額




$data1=http_build_query(array(
'RespondType'=>'String',
'Version'=>'1.1',
'Amt'=>$amt,
'MerchantOrderNo'=>$mon,
'TimeStamp'=>time(),
'IndexType'=>'1', //MerNO, or TradeNo
'CloseType'=>'2', //1=請款, 2=退款
//'Cancel'=>'1' //取消請退款
));


$edata1=bin2hex(openssl_encrypt($data1, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv));


?>
NWP Test - 請款<br>
Press 'submit' to query. <br>
針對交易:[<?=$mon?>]<br>
<form method=post action="https://ccore.newebpay.com/API/CreditCard/Close">
 MI: <input name="MerchantID_" value="<?=$mid?>" readonly><br>
 PostData_: <input name="PostData_" value="<?=$edata1?>" readonly><br>
<input type=submit value='Submit'>

</form>
