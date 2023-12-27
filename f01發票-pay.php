<?php
include "20231220.php"; // Include file containing MerchantID, HashKey, and HashIV 開立字軌


// Build transaction data
$data1 = http_build_query(array(
    //'MerchantID' => $mid, // Updated MerchantID
    'TimeStamp' => time(),
    'Version' => '1.0', // Confirm correct API version
    'RespondType' => 'JSON',
	'Year' => '113', //發票年度
	'Term' => '4', //發票期別
	'AphabeticLetter' => 'AA', //字軌英文代碼
	'StartNumber' => '00000001', //發票起始號碼
	'EndNumber' => '00000050', //發票結束號碼
	'Type' => '07' //發票類別
    // Other parameters as per your requirements
));

echo "Original Data:<br><font color=red>".$data1."</font><br><br>Encrypted Data:";

// AES Encrypt transaction data
$edata1 = bin2hex(openssl_encrypt($data1, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv));

// SHA256 Hash
$hashs = "HashKey=" . $key . "&" . $edata1 . "&HashIV=" . $iv;
$hash = strtoupper(hash("sha256", $hashs));

?>

<form method="post" action="https://cinv.ezpay.com.tw/Api_number_management/createNumb
er">
    <p>CompanyID_ (MID): [<font color=green><?= $mid ?></font>] <input name="CompanyID_" value="<?= $mid ?>" type="hidden"></p>
    <p>Version: 1.0 <input name="Version" value="1.0" type="hidden"></p>
	
    <p>Encrypted Data (PostData_):<br>[<font color=green><?= $edata1 ?></font>]<input name="PostData_" value="<?= $edata1 ?>" type="hidden"></p>
    
    <p><input type="submit" value="Submit"></p>
	
</form>
