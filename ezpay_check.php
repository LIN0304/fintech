<?php

//nwp-check.php
include "new.php";

//變數區
$mon="	MyOrder1700641747"; //訂單編號
$amt="1"; //訂單金額

//產參數串
$data1=http_build_query(array(
'TimeStamp'=>time(),
'Version'=>'1.0',
'MerchantID'=>$mid,
'MerchantOrderNo'=>$mon,

));
//echo "<bR>Data=[".$data1."]<br>";



//用Sha256產檢查碼
$edata1=bin2hex(openssl_encrypt($data1, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv));

$hashs="HashKey=".$key."&".$edata1."&HashIV=".$iv;

$hash=strtoupper(hash("sha256",$hashs));
?>


NWP Test - 交易查詢<br>
Press 'submit' to query.


<br><br>
<form method=post action='https://cpayment.ezpay.com.tw/API/merchant_trade/query_trade_info'>

 店號(MID):[<font color=green><?=$mid?></font>] <input name="MerchantID" value="<?=$mid?>" readonly type="hidden"><br>
 版號(Version):2.0 <input name="Version" value="1.0" readonly type="hidden"><br>
 加密資料(TradeInfo):<br>[<font color=green><?=$edata1?></font>]
 <input name="QueryInfo" value="<?=$edata1?>" readonly type="hidden"><br>
 檢核碼(TradeSha):<br>[<font color=green><?=$hash?></font>]
 <input name="QuerySha" value="<?=$hash?>" readonly type="hidden"><br><br>
NWP Test - MPG <br>
Press 'submit' to pay.<br> 
 <input type=submit>
</form>