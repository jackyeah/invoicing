<?php
if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------
$Query = $success = $msg = "";

$type = $_POST["type"];
$editor_tw = htmlentities($_POST["editor_tw"],ENT_QUOTES,"UTF-8");
$editor_cn = htmlentities($_POST["editor_cn"],ENT_QUOTES,"UTF-8");
$editor_en = htmlentities($_POST["editor_en"],ENT_QUOTES,"UTF-8");

$ctype = "";
if($type == "501"){
	$ctype = "aboutMOCI";
}else if($type == "502"){
	$ctype = "recruit";
}

//writeLog("updIndexData.php","rdo_Type:".$rdo_Type." rdo_Show:".$rdo_Show);

$Query = "UPDATE moci_other SET cIntroTW = N'".$editor_tw."' , cIntroEN = '".$editor_en."' , cIntroCN = N'".$editor_cn."' WHERE ctype = '".$ctype."';";

if($Query != ""){
    $updData = $db->Query($Query);
    $success = $updData['success'];
}

if($success != "1"){
	$msg = $updData['msg']['0']['message'];
}

echo '{"success":"'.$success.'","msg":"'.$msg.'","Query":""}';