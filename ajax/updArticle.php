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
    $rdo_Status = $_POST["rdo_Status"];
    $rdo_New = $_POST["rdo_New"];
    $rdo_Top = $_POST["rdo_Top"];
    $sl_Type = $_POST["sl_Type"];
    $type = $_POST["type"];

    $Title_tw = htmlentities($_POST["Title_tw"],ENT_QUOTES,"UTF-8");
    $Title_cn = htmlentities($_POST["Title_cn"],ENT_QUOTES,"UTF-8");
    $Title_en = htmlentities($_POST["Title_en"],ENT_QUOTES,"UTF-8");

    $Summary_tw = htmlentities($_POST["Summary_tw"],ENT_QUOTES,"UTF-8");
    $Summary_cn = htmlentities($_POST["Summary_cn"],ENT_QUOTES,"UTF-8");
    $Summary_en = htmlentities($_POST["Summary_en"],ENT_QUOTES,"UTF-8");

    $editor_tw = htmlentities($_POST["editor_tw"],ENT_QUOTES,"UTF-8");
    $editor_cn = htmlentities($_POST["editor_cn"],ENT_QUOTES,"UTF-8");
    $editor_en = htmlentities($_POST["editor_en"],ENT_QUOTES,"UTF-8");

    $Author_tw = htmlentities($_POST["Author_tw"],ENT_QUOTES,"UTF-8");
    $Author_cn = htmlentities($_POST["Author_cn"],ENT_QUOTES,"UTF-8");
    $Author_en = htmlentities($_POST["Author_en"],ENT_QUOTES,"UTF-8");

    $Translator_tw = htmlentities($_POST["Translator_tw"],ENT_QUOTES,"UTF-8");
    $Translator_cn = htmlentities($_POST["Translator_cn"],ENT_QUOTES,"UTF-8");
    $Translator_en = htmlentities($_POST["Translator_en"],ENT_QUOTES,"UTF-8");
}

//writeLog("updIndexData.php","rdo_Type:".$rdo_Type." rdo_Show:".$rdo_Show);
$Query = $success = $msg = "";
if($pType == "A"){
    $Query = "INSERT INTO moci_know (kAType, kSubjectTW, kSubjectEN,kSubjectCN,kIntroTW,kIntroEN,kIntroCN,kContentTW,kContentEN,kContentCN,kPostDT,kUpDT,kDownDT,kAuthorTW,kAuthorEN,kAuthorCN,kTranslatorTW,kTranslatorEN,kTranslatorCN,kKeepNew,kTop,kEnable,kPic,kType) VALUES ('".$sl_Type."', N'".$Title_tw."', '".$Title_en."', N'".$Title_cn."', N'".$Summary_tw."', '".$Summary_en."', N'".$Summary_cn."', N'".$editor_tw."', '".$editor_en."', N'".$editor_cn."', '".$PostDate."', '".$StartDate."', '".$EndDate."', N'".$Author_tw."', '".$Author_en."', N'".$Author_cn."', N'".$Translator_tw."', '".$Translator_en."', N'".$Translator_cn."', '".$rdo_New."', '".$rdo_Top."', '".$rdo_Status."', '', $type);";
}else if($pType == "U"){
    $Query = "UPDATE moci_know SET kAType = '".$sl_Type."' , kSubjectTW = N'".$Title_tw."' , kSubjectEN = '".$Title_en."' , kSubjectCN = N'".$Title_cn."' , kIntroTW = N'".$Summary_tw."' , kIntroEN = '".$Summary_en."' , kIntroCN = N'".$Summary_cn."' , kContentTW = N'".$editor_tw."' , kContentEN = '".$editor_en."' , kContentCN = N'".$editor_cn."' , kPostDT = '".$PostDate."' , kUpDT = '".$StartDate."' , kDownDT = '".$EndDate."' , kAuthorTW = N'".$Author_tw."' , kAuthorEN = '".$Author_en."' , kAuthorCN = N'".$Author_cn."' , kTranslatorTW = N'".$Translator_tw."' , kTranslatorEN = '".$Translator_en."' , kTranslatorCN = N'".$Translator_cn."' , kKeepNew = '".$rdo_New."' , kTop = '".$rdo_Top."' , kEnable = '".$rdo_Status."'  WHERE id = '".$id."';";
}else if($pType == "D"){
    $Query = "DELETE FROM moci_know WHERE id = '".$id."';";
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

    $images = glob('./upload/AWMS/*.jpg');
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