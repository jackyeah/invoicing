<?php
/*
* 使用者管理模組
*
*/

class User{
  var $proxyip = "";      // user come from proxy
  var $userip = "";       // user ip
  var $Wsmk;              // web services
  var $Domd;
  var $MyLang;


	function User(){
		global $Wsmk, $Domd, $MyLang;
		$this->Wsmk = $Wsmk;
		$this->Domd = $Domd;
		$this->MyLang = $MyLang;
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$this->proxyip =  $_SERVER["REMOTE_ADDR"];
			$this->userip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else {
			$this->proxyip = "";
			$this->userip =  $_SERVER["REMOTE_ADDR"];
		}
	}


	/**
	 * 判斷是否已經登入
	 *
	 */
	function IsLogin(){
		if(isset($_SESSION["UserName"]))
		  return true;
		else
      return false;
	}

  /**
   * 判斷是否登入 - web services 端
   **/
  function chkSession()
  {
	  $langArr = $this->MyLang->getLangArr("Menu");
		$xmlObj = $this->Wsmk->chkSession();
		if($xmlObj->chkSessionSuccess == 1)
		{
			if($xmlObj->chkSessionresult == 1)
			{
				global $menu;
				$menu = "";
				$menuScript = "<script type=\"text/javascript\">
								function logout()
								{
									if(confirm(\"".$langArr["G_lang_Menu_ConfirmLogout"]."\"))
									{
										window.top.location.replace('rs.php?fp=logout');
									}
								}
								function OPenUpdPWD()
								{
									$('#div_updPWD').modal({containerCss: {width: 250,height: 260}});
								}
								function updPWD()
								{
									var msg = \"\";
									var OldPWD = $(\"#OldPWD\").val();
									var NewPWD = $(\"#NewPWD\").val();
									var chkNewPWD = $(\"#chkNewPWD\").val();

									if(OldPWD == \"\")
									{
										msg += \"".$langArr["G_lang_EditPWD1"]."\\n\";
									}

									if(NewPWD == \"\")
									{
										msg += \"".$langArr["G_lang_EditPWD2"]."\\n\";
									}
									else
									{
										if(chkEngNum(NewPWD))
										{
											msg += \"".$langArr["G_lang_EditPWD3"]."\\n\";
										}
									}

									if(chkNewPWD == \"\")
									{
										msg += \"".$langArr["G_lang_EditPWD4"]."\\n\";
									}
									else
									{
										if(NewPWD != chkNewPWD)
										{
											msg += \"".$langArr["G_lang_EditPWD5"]."\\n\";
										}
									}

									if(msg == \"\")
									{
										$.modal.close();
										TreeGridLoad();
										$.post(\"rs.php?fp=AJAXupdPassword_all\",
										{
											OldPWD:OldPWD,
											NewPWD:NewPWD,
										},
										function(redata)
										{
											var data = redata.substr(1, redata.length);
											TreeGriddispalyLoad();
											if(redata.substr(0,1) == \"1\")
											{
												alert(data);
											}
											else if(redata.search(\"!DOC\") > -1)
											{
												//if(redata.search(\"doLogin\") > -1)
												//{
													alert(\"".$langArr["G_lang_InformationError"]."\");
													window.top.location.replace('rs.php?fp=logout');
												//}
												//else
												//{
													//alert(\"Web Service Error\");
												//}
											}
											else
											{

												alert(data);
											}
										});
									}
									else
									{
										alert(msg);
									}
								}
								</script>";
				//Head 圖片
				$TopMenu = "<div id=\"top\">
        						<div style=\"height:81px ; width:973px; background-image: url(images/harder_bg.jpg); color:red;\"><span style=\"position:relative; top:45px; left:235px;\">".TFGRS_Version."</span></div>
								<div class=\"UserText\">".$langArr["G_lang_Menu_Welcome"]."&nbsp;&nbsp;".$_SESSION["UserName"]."(".$_SESSION["UserAccount"].")".$langArr["G_lang_Menu_Administrator"]."&nbsp;&nbsp;<a href=\"#\" onclick=\"OPenUpdPWD()\">【".$langArr["G_lang_Menu_UpdPWD"]."】</a><a href=\"#\" onClick=\"logout()\">【".$langArr["G_lang_Menu_Logout"]."】</a>
								<ul class=\"dropdown\">";
				$GroupMenu = "<table class=\"MenuTable\">";
				$MenuHref = "";
				$xmlObj_userright = $xmlObj->userright;
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
							$MenuHref = "#";
						}
						$TopMenu .= "<li><a href=\"".$MenuHref."\" id=\"top".$menu_id."\">".$name."</a>";

						//針對警訊管理的動作，新增一個副Menu
						if($menu_id == "3"){
							$GroupMenu .= "<tr style=\"display:none;\" id=\"Group".$menu_id."\">";
							$GroupMenu .= "<td align=\"center\"><a href=\"".$MenuHref."\" id=\"group".$menu_id."\">".$langArr["G_lang_AlarmTitle"]."</a></td>";
							$GroupMenu .= "</tr>";
						}

						if(!empty($kVal->submenu)){
							$TopMenu .= "<ul class=\"sub_menu\">";
							$GroupMenu .= "<tr style=\"display:none;\" id=\"Group".$menu_id."\">";
							foreach ($kVal->submenu as $kVal_sub){
								$menu_id = $kVal_sub->menu_id;
								$name = $kVal_sub->name;
								$program = $kVal_sub->program;
								$program = str_replace(".php","",$program);
								$linkflag = $kVal_sub->linkflag;
								if($linkflag != "0"){
									$MenuHref = "rs.php?fp=".$program;
								}else{
									$MenuHref = "#";
								}
								$TopMenu .= "<li><a href=\"".$MenuHref."\" id=\"".$menu_id."\">".$name."</a></li>";
								$GroupMenu .= "<td align=\"center\"><a href=\"".$MenuHref."\" id=\"group".$menu_id."\">".$name."</a></td>";
							}
							$TopMenu .= "</ul>";
							$GroupMenu .= "</tr>";
						}
						$TopMenu .= "</li>";
					}
				}
				$GroupMenu .= "</table>";

				//修改密碼視窗
				$GroupMenu .= "<div id=\"div_updPWD\" style=\"display:none\">
								<label style=\"font-size:18px; position:relative; top:-6px;\">".$langArr["G_lang_Menu_UpdPWD"]."</label>
								<div style=\" margin:5px 0 5px 0; border: 1px solid #a6a6a6; color:#FFF; padding:13px 6px 13px;\">
								".$langArr["G_lang_OldPWD"].":<br /><br /><input class=\"InputText_Edit1\" style=\"margin-right:5px\" id=\"OldPWD\" type=\"password\" value=\"\" /><br /><br />
								".$langArr["G_lang_NewPWD"].":<br /><br /><input class=\"InputText_Edit1\" style=\"margin-right:5px\" id=\"NewPWD\" type=\"password\" value=\"\" /><br /><br />
								".$langArr["G_lang_ConfirmPWD"].":<br /><br /><input class=\"InputText_Edit1\" style=\"margin-right:5px\" id=\"chkNewPWD\" type=\"password\" value=\"\" /><br /><br />
								</div>
							<div align=\"right\">
								<input class=\"Button_Select\" type=\"button\" value=\"".$langArr["G_lang_Determine"]."\" onClick=\"updPWD()\">&nbsp;
								<input class=\"Button_Select\" type=\"button\" value=\"".$langArr["G_lang_Cancel"]."\" onClick=\"$.modal.close()\">
							</div>
							</div>";

				//歡迎詞、修改密碼、登出
				$TopMenu .= "</ul></div></div>";
				$Freeow = '<div id="freeow" class="freeow freeow-bottom-right"></div>';
				$menu = $menuScript.$TopMenu.$GroupMenu.$Freeow;
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    //return ($xmlObj->chkSessionSuccess == 1)?true:false;
  }

	/**
	 *  登入檢查處理
	 *  所有session的值,若要使用請在此註冊 以方便維護
	 */
	function Login($loginid, $password, $lang){
		if ($this->IsLogin()) return true;
		$xmlObj = $this->Wsmk->doLogin($loginid,$password,$lang);

		if($xmlObj->doLoginSuccess == 1 && $xmlObj->message == ""){
		  $_SESSION["UserID"] = strval($xmlObj->userid);
		  $_SESSION["UserName"] = strval($xmlObj->username);
		  $_SESSION["UserAccount"] = strval($xmlObj->user_account);
		  $_SESSION["UserGroup"] = strval($xmlObj->user_group_id);

		  //return true;
		  return "1,".(string)$xmlObj->menu_program;
		}else{
		  $this->Logout();
		  return "0,".(string)$xmlObj->message;
		}
	}

	/**
	* 登出處理
	*/
	function Logout(){
		unset($_SESSION);
		@session_destroy();
	}

	function GetSID(){
		return md5(time().$_SERVER["REMOTE_ADDR"]);
	}


	function GetClientInfo(){
		return array(
			"ip" => $this->userip,
			"host" => gethostbyaddr($this->userip),
			"proxy" => $this->proxyip,
			"proxyhost" => gethostbyaddr($this->proxyip)
			);
	}


  function encode($str) {
    return md5(base64_encode($str));
  }

}