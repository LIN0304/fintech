<?php
//npa-b06.php

include "merc.php";

$json = json_encode([
'MerchantOrderNo' => 'MyOrder1698215381',
'Amount' => '30',
'TimeStamp' => time(),
'PaymentType' => 'ESUNWALLET',
]);

$encryptString = bin2hex(openssl_encrypt($json, "AES-256-CBC",$key, OPENSSL_RAW_DATA, $iv));

$hashString = "HashKey=".$key."&".$encryptString."&HashIV=".$iv;
$hashValue = strtoupper(hash("sha256",$hashString));

?>

<form method="post" action="https://ccore.newebpay.com/API/EWallet/refund">
 UID_:<input name="UID_" value="<?=$mid?>" readonly><br>
 Version_:<input name="Version_" value="1.0" readonly><br>
 EncryptData_:<input name="EncryptData_" value="<?=$encryptString?>" readonly><br>
 RespondType_:<input name="RespondType_" value="JSON" readonly><br>
 HashData_:<input name="HashData_" value="<?=$hashValue?>" readonly><br>
<input type=submit value='Submit'>

</form>