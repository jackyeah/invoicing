<?php
if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------
$id = $_POST["id"];
$pType = $_POST["pType"];
if($pType != "D"){
    $sl_Type = $_POST["sl_Type"];
    $rdo_Status = $_POST["rdo_Status"];
    $rdo_Index = $_POST["rdo_Index"];
    $logoColor = $_POST["logoColor"];
    $cSort = $_POST["cSort"];
    $nowSort = $_POST["nowSort"];
    $Title_tw = htmlentities($_POST["Title_tw"],ENT_QUOTES,"UTF-8");
    $Title_cn = htmlentities($_POST["Title_cn"],ENT_QUOTES,"UTF-8");
    $Title_en = htmlentities($_POST["Title_en"],ENT_QUOTES,"UTF-8");
    $editor_tw = htmlentities($_POST["editor_tw"],ENT_QUOTES,"UTF-8");
    $editor_cn = htmlentities($_POST["editor_cn"],ENT_QUOTES,"UTF-8");
    $editor_en = htmlentities($_POST["editor_en"],ENT_QUOTES,"UTF-8");

    // 取出目前最大排序+1
	$getData = $db->Query("select MAX(csort)+1 as maxid from moci_client");
	if($getData['success'] == "1"){
		$NewSort = $getData['row']['maxid'];
	}

	// 若使用者有輸入跟預設的排序不同的值
	$chgSort = false;
	if($cSort != $nowSort && $pType != "D"){
		if($cSort == "" || (int)$cSort > (int)$NewSort || (int)$cSort == (int)$NewSort){
			$cSort = $NewSort;
		}else if((int)$cSort < (int)$NewSort){
			$chgSort = true;
		}
	}else{
		$cSort = $nowSort;
	}

	//更改排序
	if($chgSort == true){
		$Query = "update moci_client set cSort=cSort+1 where cSort>=".$cSort.";";
	}
}

//writeLog("updIndexData.php","rdo_Type:".$rdo_Type." rdo_Show:".$rdo_Show);
$Query = $success = $msg = "";

if($pType == "A"){
    $Query .= "INSERT INTO moci_client (cType, cHomeView, cNameTW,cNameEN,cNameCN,cIntroTW,cIntroEN,cIntroCN,cPath,cLogoPath,cColor,cEnable,cSort) VALUES ('".$sl_Type."', '".$rdo_Index."', N'".$Title_tw."','".$Title_en."',N'".$Title_cn."',N'".$editor_tw."','".$editor_en."',N'".$editor_cn."','','','".$logoColor."','".$rdo_Status."','".$cSort."');";
}else if($pType == "U"){
    $Query .= "UPDATE moci_client SET cType = '".$sl_Type."' , cHomeView = '".$rdo_Index."' , cNameTW = N'".$Title_tw."' , cNameEN = '".$Title_en."' , cNameCN = N'".$Title_cn."' , cIntroTW = N'".$editor_tw."' , cIntroEN = '".$editor_en."' , cIntroCN = N'".$editor_cn."' , cColor = '".$logoColor."' , cEnable = '".$rdo_Status."' , cSort = '".$cSort."'  WHERE id = '".$id."';";
}else if($pType == "D"){
    $Query = "DELETE FROM moci_client WHERE id = '".$id."';";
}

if($Query != ""){
    if($pType == "A"){
        $updData = $db->QueryAndGetID($Query);
        $msg = $updData['msg'];
    }else{
        $updData = $db->Query($Query);
    }
    $success = $updData['success'];
}

if($success != "1"){
	$msg = $updData['msg']['0']['message'];
}

// 刪除圖片跟logo
if($pType == "D" && $success == "1"){
	$pathArray = array();
	if (is_file('./upload/customer/logo/'.$id.'.jpg')) {
		$pathArray[] = './upload/customer/logo/'.$id.'.jpg';
	}

	$images = glob('./upload/customer/*.jpg');
	foreach ($images as  $imgPath) {
		$fileName = basename($imgPath,".jpg");
		$fileNameArray = explode('_', $fileName);
		$fileID = $fileNameArray[0];
		if($fileID == $id){
			$pathArray[] = $imgPath;
		}
	}

	foreach ($pathArray as  $filePath) {
		if (is_file($filePath)) {
		   	chmod($filePath, 0777);
		   	if(is_writable($filePath)){
			   if (unlink($filePath)) {
			      $success = "1";
			   } else {
			      $success = "0";
			      $msg = "刪除檔案錯誤".$filePath;
			   }
			}else{
			      $success = "0";
			      $msg = "權限不足".$filePath;
			}
		   print_r(error_get_last());
		} else {
			$success = "0";
			$msg = "檔案路徑錯誤".$filePath;
		}
	}
}
echo '{"success":"'.$success.'","msg":"'.$msg.'","Query":""}';