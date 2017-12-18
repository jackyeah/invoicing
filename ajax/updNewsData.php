<?php
if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------
$id = $_POST["id"];
$pType = $_POST["pType"];
if($pType != "D"){
	$PostDate = $_POST["PostDate"];
	$StartDate = $_POST["StartDate"];
	$EndDate = $_POST["EndDate"];
	$rdo_Hot = $_POST["rdo_Hot"];
	$EndDate_Hot = $_POST["EndDate_Hot"];
	$Title_tw = htmlentities($_POST["Title_tw"],ENT_QUOTES,"UTF-8");
	$Title_cn = htmlentities($_POST["Title_cn"],ENT_QUOTES,"UTF-8");
	$Title_en = htmlentities($_POST["Title_en"],ENT_QUOTES,"UTF-8");
	$editor_tw = htmlentities($_POST["editor_tw"],ENT_QUOTES,"UTF-8");
	$editor_cn = htmlentities($_POST["editor_cn"],ENT_QUOTES,"UTF-8");
	$editor_en = htmlentities($_POST["editor_en"],ENT_QUOTES,"UTF-8");
}

//writeLog("updIndexData.php","rdo_Type:".$rdo_Type." rdo_Show:".$rdo_Show);
$Query = $success = $msg = "";
if($pType == "A"){
	$Query = "INSERT INTO moci_News (PostDT, startDT, endDT,subjectTW,subjectEN,subjectCN,contentTW,contentEN,contentCN,nEnable,HOT,HotEndDT) VALUES ('".$PostDate."', '".$StartDate."', '".$EndDate."','".$Title_tw."','".$Title_en."','".$Title_cn."','".$editor_tw."','".$editor_en."','".$editor_cn."','1','".$rdo_Hot."','".$EndDate_Hot."');";
}else if($pType == "U"){
	$Query = "UPDATE moci_News SET PostDT = '".$PostDate."' , startDT = '".$StartDate."' , endDT = '".$EndDate."' , subjectTW = N'".$Title_tw."' , subjectEN = '".$Title_en."' , subjectCN = N'".$Title_cn."' , contentTW = N'".$editor_tw."' , contentEN = '".$editor_en."' , contentCN = N'".$editor_cn."' , HOT = '".$rdo_Hot."' , HotEndDT = '".$EndDate_Hot."'  WHERE id = '".$id."';";
}else if($pType == "D"){
	$Query = "DELETE FROM moci_News WHERE id = '".$id."';";
}
if($Query != ""){
	$updData = $db->Query($Query);
	$success = $updData['success'];
}

if($success != "1"){
	$msg = $updData['msg']['0']['message'];
}

echo '{"success":"'.$success.'","msg":"'.$msg.'","Query":""}';