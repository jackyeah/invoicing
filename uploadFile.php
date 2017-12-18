<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2017/10/27
 * Time: 上午 10:31
 */

if ($_FILES["fileUpload"]["error"] > 0){
    echo "Error: " . $_FILES["fileUpload"]["error"];
}else{
    echo "檔案名稱: " . $_FILES["fileUpload"]["name"]."<br/>";
    echo "檔案類型: " . $_FILES["fileUpload"]["type"]."<br/>";
    echo "檔案大小: " . ($_FILES["fileUpload"]["size"] / 1024)." Kb<br />";
    echo "暫存名稱: " . $_FILES["fileUpload"]["tmp_name"]."<br/>";

    echo '上傳類型' . $_POST['upload_type'];
}