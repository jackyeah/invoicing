<?php
if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------
$type = $_POST["type"];
$fileName = $_POST["fileName"];

$success = "1";
$msg = "";
$filePath = "";
// -----------------------------------------------------------------------------
// Start
// -----------------------------------------------------------------------------
switch ($type) {
	case '01':
		$filePath = "upload/index/".$fileName;
		break;
	case '02':
		$filePath = "upload/customer/".$fileName;
		break;
	case '03':
		$filePath = "upload/AWMS/".$fileName;
		break;
	case '04':
		$filePath = "upload/Logistics/".$fileName;
		break;

	default:
		# code...
		break;
}
if (is_file($filePath)) {
   	chmod($filePath, 0777);
   	if(is_writable($filePath)){
	   if (unlink($filePath)) {
	      $success = "1";
	   } else {
	      $success = "0";
	      $msg = "刪除檔案錯誤";
	   }
	}else{
	      $success = "0";
	      $msg = "權限不足";
	}
   print_r(error_get_last());
} else {
	$success = "0";
	$msg = "檔案路徑錯誤";
}

echo '{"success":"'.$success.'","msg":"'.$msg.'"}';