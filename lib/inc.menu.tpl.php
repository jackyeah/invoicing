<?php
$langArr = $MyLang->getLangArr("Menu");
$menu = $menuScript = $MenuHref = "";
$xmlObj_userright = $xmlObj->userright;

$rs20100Array = array("rs20100_editT","rs20100_editA","rs20100_exe","rs20100_tmp","rs20100_tmp4","rs20100_exe4");

$menu2 = array();

if(!empty($xmlObj_userright->menudata)){
        foreach ($xmlObj_userright->menudata as $kVal){

            $menu_id = $kVal->menu_id;
            $name = $kVal->name;
            $program = $kVal->program;
            $program = str_replace(".php","",$program);
            $linkflag = $kVal->linkflag;

            if($linkflag != "0"){
                $MenuHref = "rs.php?fp=".$program;
            }else{
                $MenuHref = "javascript:void(0)";
            }
            $menu2[(string)$kVal->menu_id] = array( 'text' =>  $kVal->name , 'idx' => (string)$kVal->menu_id  );
            $menu2[(string)$kVal->menu_id]['path'] = $MenuHref ;
            if($program == 'rs30100_lis'){
                if($_GET['fp'] == 'rs30100_lis' || $_GET['fp'] == 'rs30100_edit'){
                    $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                    $breadcrumb = "<a href='{$MenuHref}' >" . $kVal->name . "</a>" ;
                }
            }
            else if( $_GET['fp'] == $program ){
                $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                $breadcrumb = "<a href='{$MenuHref}' >" . $kVal->name . "</a> > " ;
            }

            if(!empty($kVal->submenu)){
                foreach ($kVal->submenu as $kVal_sub){
                    $menu_id = $kVal_sub->menu_id;
                    $name = $kVal_sub->name;
                    $program = $kVal_sub->program;
                    $program = str_replace(".php","",$program);
                    $linkflag = $kVal_sub->linkflag;
                    $subMenuHref = $linkflag != "0" ? "rs.php?fp=".$program : "#";

                    if( $_GET['fp'] == $program ){
                        $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                        $breadcrumb = "<a href='{$MenuHref}' >". $kVal->name . "</a> > <a href='{$subMenuHref}' >" . $kVal_sub->name . "</a>" ;
                    }else if(in_array($_GET['fp'], $rs20100Array)){
                        if($program == "rs20100_lis"){
                            $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                            $breadcrumb = "<a href='{$MenuHref}' >". $kVal->name . "</a> > <a href='{$subMenuHref}' >" . $kVal_sub->name . "</a>" ;
                        }
                    }else if($_GET['fp'] == 'rs20200_edit'){
                        if($program == "rs20200_lis"){
                            $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                            $breadcrumb = "<a href='{$MenuHref}' >". $kVal->name . "</a> > <a href='{$subMenuHref}' >" . $kVal_sub->name . "</a>" ;
                        }
                    }else if($_GET['fp'] == 'rs40300_edit'){
                        if($program == "rs40300_lis"){
                            $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                            $breadcrumb = "<a href='{$MenuHref}' >". $kVal->name . "</a> > <a href='{$subMenuHref}' >" . $kVal_sub->name . "</a>" ;
                        }
                    }else if($_GET['fp'] == 'rs40400_edit'){
                        if($program == "rs40400_lis"){
                            $menu2[(string)$kVal->menu_id]['active'] = 'active' ;
                            $breadcrumb = "<a href='{$MenuHref}' >". $kVal->name . "</a> > <a href='{$subMenuHref}' >" . $kVal_sub->name . "</a>" ;
                        }
                    }

                    $menu2[(string)$kVal->menu_id]['sub'][(string)$kVal_sub->menu_id] = array( 'path' =>$subMenuHref
                                                                               , 'text' => (string)$kVal_sub->name
                                                                               ,'idx' => (string)$kVal->menu_id."-".$kVal_sub->menu_id ) ;
                }
            }
        }
    }

    $assignMenu = $menu2;


?>