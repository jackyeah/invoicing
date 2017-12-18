<?php
require_once dirname(__FILE__) . '/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(dirname(__FILE__) . '/../template');
$twig = new Twig_Environment($loader);
$twgiTpl = array();

$assign = $tpl ;

$twgiTpl['G_TEMPLATE'] = "layout" ;
//$twgiTpl['G_LANG'] = G_LANG ;
//$twgiTpl['SESSION'] = $_SESSION;
//$twgiTpl['fp'] = $_GET['fp'];

$tpl_folder = $twgiTpl['G_TEMPLATE'] . '\\' ;


function tpl_assign($assign = null , $tpl_page){
    global $twgiTpl , $langArr , $tpl_folder;
    $assign['tpl'] = array( 'main_content' => $tpl_folder.$tpl_page );
    return array_merge($twgiTpl , $assign);
}

function tpl_topmenu(){
    global $g_myLangArr , $Wsmk , $User ;
     return $menu2 ;
}
?>