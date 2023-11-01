<?php

//nwp-check.php
include "merc.php";

//變數區
$mon="MyOrder1698820206"; //訂單編號
$amt="30"; //訂單金額

//產參數串
$data1=http_build_query(array(
'Amt'=>$amt,
'MerchantID'=>$mid,
'MerchantOrderNo'=>$mon
));
echo "<bR>Data=[".$data1."]<br>";



//用Sha256產檢查碼
$hashs="IV=".$iv."&".$data1."&Key=".$key;
echo "<bR>Before Hash=[".$hashs."]<br>";
$hash=strtoupper(hash("sha256",$hashs));
echo "<bR>Hash=[".$hash."]<br>";

?>


NWP Test - 交易查詢<br>
Press 'submit' to query.



<form id="aa" method=post action="http://ccore.newebpay.com/API/QueryTradeInfo">
商店: <input name="MerchantID" value="<?=$mid?>" readonly><br>
版號: <input name="Version" value="1.3" readonly><br>
回傳型態會是:<input name="RespondType" value="JSON" readonly><br>
檢查碼:<input name="CheckValue" value="<?=$hash?>" readonly><br>
時間戳記:<input name="TimeStamp" value="<?=time()?>" readonly><br>
商店訂單編號:<input name="MerchantOrderNo" value="<?=$mon?>" readonly><br>
金額:<input name="Amt" value="<?=$amt?>" readonly><br>

<input type=submit>
</form>