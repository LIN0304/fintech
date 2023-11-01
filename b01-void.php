<?php
//nwp-void.php

//NPA-B01 VOID
include "merc.php";

//變數區
$mon="MyOrder1697613159"; //訂單編號
$amt="1"; //訂單金額

$data1=http_build_query(array(
'RespondType'=>'String',
'Version'=>'1.0',
'TimeStamp'=>time(),
'Amt'=>$amt,
'MerchantOrderNo'=>$mon,
'IndexType'=>'1',
));


$edata1=bin2hex(openssl_encrypt($data1, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv)); //加密TradeInfo

$hashs="HashKey=".$key."&".$edata1."&HashIV=".$iv; //組成Hash原料

$hash=strtoupper(hash("sha256",$hashs)); //丟Hash


?>

<form method=post action="https://ccore.newebpay.com/API/CreditCard/Cancel">
MI: <input name="MerchantID_" value="<?=$mid?>"><br>
TradeInfo: <input name="PostData_" value="<?=$edata1?>"><br>
<input type=submit>
</form>
