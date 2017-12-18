<?php
//if (!defined('IN_MOCI')) {die ("You can't access this file directly...");}
// -----------------------------------------------------------------------------
// 設定值
// -----------------------------------------------------------------------------

$imgs = array();
$imgs[0] = '../upload/index/1.jpg';
$target = '../upload/index/2.jpg';//背景图片
$target_img = Imagecreatefromjpeg($target);
$source= array();
foreach ($imgs as $k=>$v){
    $source[$k]['source'] = Imagecreatefromjpeg($v);
    $source[$k]['size'] = getimagesize($v);
}
//imagecopy ($target_img,$source[0]['source'],2,2,0,0,$source[0]['size'][0],$source[0]['size'][1]);
//imagecopy ($target_img,$source[1]['source'],250,2,0,0,$source[1]['size'][0],$source[1]['size'][1]);
$num1=0;
$num=3; //控制列数，一行几列，0为1以此类推。
$tmp=2;
$tmpy=2; //图片之间的间距
for ($i=0; $i<1; $i++){ 
    imagecopy($target_img,$source[$i]['source'],$tmp,$tmpy,0,0,$source[$i]['size'][0],$source[$i]['size'][1]);
    $tmp = $tmp+$source[$i]['size'][0];
    $tmp = $tmp+5;
    if($i==$num){
        $tmpy = $tmpy+$source[$i]['size'][1];
        $tmpy = $tmpy+5;
        $tmp=2;
        $num=$num+3;
    }
}
Imagejpeg($target_img,'../upload/index/pin.jpg');

echo '1';