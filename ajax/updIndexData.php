<?php
if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------
$Query = $success = $msg = "";

$rdo_Type = $_POST["rdo_Type"];
$rdo_Show = $_POST["rdo_Show"];
$StartDate = $_POST["StartDate"];
$EndDate = $_POST["EndDate"];
$editor_tw = htmlentities($_POST["editor_tw"],ENT_QUOTES,"UTF-8");
$editor_cn = htmlentities($_POST["editor_cn"],ENT_QUOTES,"UTF-8");
$editor_en = htmlentities($_POST["editor_en"],ENT_QUOTES,"UTF-8");

//writeLog("updIndexData.php","rdo_Type:".$rdo_Type." rdo_Show:".$rdo_Show);
$Query = "UPDATE moci_config SET cValue = '".$rdo_Type."' WHERE cType = 'homeView';";
$Query .= "UPDATE moci_config SET cValue = '".$rdo_Show."' WHERE cType = 'homePop';";
$Query .= "UPDATE moci_pop SET pUpDT = '".$StartDate."' , pDownDT = '".$EndDate."' , pContentTW = N'".$editor_tw."' , pContentCN = N'".$editor_cn."' , pContentEN = '".$editor_en."' , UpdDate = '".date("Y-m-d H:i:s")."' WHERE id = '2';";

$updData = $db->Query($Query);
$success = $updData['success'];

if($success != "1"){
	$msg = $updData['msg']['0']['message'];
}
echo '{"success":"'.$success.'","msg":"'.$msg.'","Query":""}';