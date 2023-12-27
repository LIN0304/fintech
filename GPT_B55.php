<?php
include "merc.php";

// 定義外層參數與其對應的內層參數
$data1 = json_encode(array(
    
    'TimeStamp' => time(), // Unix時間戳記
    'LgsType' => 'C2C', // 物流型態（例如 C2C=店到店）
    'ShipType' => '2', // 物流廠商類別（例如 1=7-ELEVEN）
    'MerchantOrderNo' => ["MyOrder1703667001"],
));

echo "原始資料:<br><font color=red>".$data1."</font><br><br>加密資料:";

$edata1 = bin2hex(openssl_encrypt($data1, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv));
$hashs = "HashKey=".$key."&".$edata1."&HashIV=".$iv;
$hash = strtoupper(hash("sha256", $hashs));

?>

<form method="post" action="https://ccore.newebpay.com/API/Logistic/printLabel">
    店號(UID_): [<font color=green><?=$mid?></font>] <input name="UID_" value="<?=$mid?>" readonly type="hidden"><br>
    版號(Version_): 1.0 <input name="Version_" value="1.0" readonly type="hidden"><br>
    版號(RespondType_): 1.0 <input name="RespondType_" value="JSON" readonly type="hidden"><br>
    加密資料(EncryptData_):<br>[<font color=green><?=$edata1?></font>]
    <input name="EncryptData_" value="<?=$edata1?>" readonly type="hidden"><br>
    檢核碼(HashData_):<br>[<font color=green><?=$hash?></font>]
    <input name="HashData_" value="<?=$hash?>" readonly type="hidden"><br><br>
    NWP Test - MPG <br>
    Press 'submit' to pay.<br> 
    <input type="submit">
</form>
