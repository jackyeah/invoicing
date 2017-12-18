<?php
$config=array();
$config['type']=array("flash","img"); //上傳允許類型
$config['img']=array("jpg","bmp","gif","png"); //img允許檔案類別
$config['flash']=array("flv","swf"); //flash允許檔案類別
$config['flash_size']=20000; //上傳flash大小上限制大小 200KB
$config['img_size']=50000; //上傳img大小上限制大小 500KB
$config['message']="upload success";
$config['name']= 'img_editor_'.mktime(); //上傳文件命名方式, 用時間.
$config['flash_dir']="/home/rdmb0369/images/news"; //上傳flash文件路徑
$config['img_dir'] ="/img"; //上傳img文件路徑
$config['site_url']="http://local/SysAdmin/"; //URL
uploadfile();

function uploadfile()
{
    global $config;

    $error = "";
    $msg = "";

    if (empty($_GET['CKEditorFuncNum'])) {
        $error = "1";
    }

    $fn = $_GET['CKEditorFuncNum'];

    /*if (!in_array($_GET['type'], $config['type'])) {
        $error = "2";
    }*/

    $type = 'img';

    if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
        $filearr = pathinfo($_FILES['upload']['name']);
        $filetype = $filearr["extension"];

        if (!in_array($filetype, $config[$type])) {
            $error = "3";
        }
        //mkhtml($fn,"","請檢查的文件類型！"); //判?文件大小是否符合要求

        if ($_FILES['upload']['size'] > $config[$type . "_size"] * 1024) {
            $error = "4";
        }
        //mkhtml($fn,"","上傳的文件不能超過".$config[$type."_size"]."KB！");

        $file_abso = $config[$type . "_dir"] . "/" . $config['name'] . "." . $filetype;
        $file_host = $_SERVER['DOCUMENT_ROOT'] . $file_abso;

        error_log('tmp file:' . $_FILES['upload']['tmp_name'] . "\n\r\n\r", 3, '/home/log/upload.log');
        error_log('DOCUMENT_ROOT:' . $_SERVER['DOCUMENT_ROOT'] . "\n\r\n\r", 3, '/home/log/upload.log');
        error_log('$file_abso:' . $file_abso . "\n\r\n\r", 3, '/home/log/upload.log');
        if (move_uploaded_file($_FILES['upload']['tmp_name'], '/home/rdmb0369/images/news/' . $config['name'] . "." . $filetype)) {

        } else {
            $error = "5";
            mkhtml($fn, "", "請檢查目錄權限");
        }


        if ($error == "") {
            //$img = "http://".$_SERVER['HTTP_HOST'].$file_abso;
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(" . $fn . ",'" . 'http://win.wxmsg.cn/cq9-promo-pic/news/' . $config['name'] . "." . $filetype . "','');</script>";
        } else {
            switch ($error) {
                case '1':
                    $msg = "檔案類型不正確";
                    break;
                case '2':
                    $msg = "檔案類型不正確";
                    break;
                case '3':
                    $msg = "請檢查的文件類型！";
                    break;
                case '4':
                    $msg = "上傳的文件不能超過" . $config[$type . "_size"] . "KB！";
                    break;
                case '5':
                    $msg = "請檢查目錄權限";
                    break;
                default:
                    break;
            }
            error_log('msg' . $msg . ';', 3, '/home/log/upload.log');
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(" . $fn . ",'','" . $msg . "');</script>";
        }
    }
}

function mkhtml($fn,$fileurl,$message) {
    $str='';
    exit($str);
}