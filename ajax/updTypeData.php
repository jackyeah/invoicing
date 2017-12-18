<?php
if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------
$updType = $_POST["updType"];
$id = $_POST["id"];
$name_tw = htmlentities($_POST["name_tw"],ENT_QUOTES,"UTF-8");
$name_en = htmlentities($_POST["name_en"],ENT_QUOTES,"UTF-8");
$name_cn = htmlentities($_POST["name_cn"],ENT_QUOTES,"UTF-8");
$type = $_POST["type"];

/*$tableName = "";
switch ($type) {
	case '1':
		$tableName = "moci_client";
		break;
	case '2':
		$tableName = "moci_know";
		break;
	case '3':
		$tableName = "moci_know";
		break;

	default:
		$tableName = "";
		break;
}*/

//writeLog("updIndexData.php","rdo_Type:".$rdo_Type." rdo_Show:".$rdo_Show);
$Query = $success = $msg = "";
if($updType == "A"){
	$Query = "INSERT INTO moci_TypeCode (NameTW, NameEN, NameCN,tcType) VALUES (N'".$name_tw."', '".$name_en."', N'".$name_cn."','".$type."');";
}else if($updType == "U"){
	$Query = "UPDATE moci_TypeCode SET NameTW = N'".$name_tw."' , NameEN = '".$name_en."' , NameCN = N'".$name_cn."' WHERE id = '".$id."';";
}else if($updType == "D"){
	$Query = "DELETE FROM moci_TypeCode WHERE id = '".$id."' and tcType = '".$type."' ;";
}

if($Query != ""){
	$updData = $db->Query($Query);
	$success = $updData['success'];
}

if($success != "1"){
	$msg = $updData['msg']['0']['message'];
}

echo '{"success":"'.$success.'","msg":"'.$msg.'","Query":""}';