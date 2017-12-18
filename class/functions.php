<?php
/**
 * Public functions
 *
 */

function cleanTmp($dir, $DeleteMe){
		if(!$dh = @opendir($dir)){
			return false;
		}

		while (false !== ($obj = readdir($dh))) {
			if($obj=='.' || $obj=='..') continue;
			if (!@unlink($dir.'/'.$obj)) cleanTmp($dir.'/'.$obj, true);
		}

		if ($DeleteMe){
			closedir($dh);
			@rmdir($dir);
		}
	}

function writeLog($page,$log){
	error_log(date("Y-m-d H:i:s")." ".$page." ".$log."\r\n", 3, "errors.log");
}

// Returns the current timestamp with microseconds.
// Used for benchmarking script execution time.
function getmicrotime()
{
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}


// return value
function GetVar($var)
{
	if (isset($_POST[$var]))
		return getslashes02($_POST[$var]);
	elseif (isset($_GET[$var]))
		return getslashes02($_GET[$var]);
	elseif (isset($_COOKIE[$var]))
		return getslashes02($_COOKIE[$var]);
	else
		return "";
}


// disable http cache
function disablecache()
{
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");                          // HTTP/1.0
}

// 將字串編碼，以防止隱碼攻擊
function sqlencode($s)
{
	//return $s;
	return str_replace("'","''", $s);
}

/**
 * Removes disallowed HTML tags from the supplied string and returns the
 * result.
 *
 * @param string $text String to process.
 * @return string Processed string.
 * @see sh(), saferHTML()
 */
function safeHTML($text)
{
	// TODO: Figure out a way to close unclosed tags.

	$text = stripslashes($text);
	//$text = strip_tags($text, ALLOWED_HTML);
	$text = eregi_replace("<a[^>]+href *= *([^ >]+)[^>]*[>]?", "<a href=\\1>", $text);
	$text = eregi_replace("<img[^>]+src *= *([^ >]+)[^>]*>", "<img src=\\1 alt=\"\" border=\"0\">", $text);
	$text = eregi_replace("<(abbr|acronym|b|big|blockquote|center|code|dd|del|dl|dt|em|h1|h2|h3|h4|h5|h6|hr|i|ins|kbd|li|ol|p|pre|q|s|samp|small|strike|strong|sub|sup|tt|u|ul|var) +[^>]*>", "<\\1>", $text);
	$text = eregi_replace("<(br)[ ]*[^>]*>", "<\\1 />", $text);
	return $text;
}

/**
 * Removes all but the safest HTML tags and returns the result.
 *
 * @param string $text String to process.
 * @return string Processed string.
 * @see sh(), safeHTML()
 */
function saferHTML($text)
{
	// TODO: Figure out a way to close unclosed tags.

	$text = stripslashes($text);
	$text = strip_tags($text, "<a><b><em><i><strong><u>");
	$text = eregi_replace("<a[^>]+href *= *([^ >]+)[^>]*[>]?", "<a href=\\1>", $text);
	$text = eregi_replace("<(b|em|i|strong|u) +[^>]*>", "<\\1>", $text);
	return $text;
}

/**
 * Given a string, strips slashes and converts some special characters to
 * their corresponding HTML entities.
 *
 * @param string String to process.
 * @return Processed string.
 */
function sh($string)
{
	return htmlspecialchars(stripslashes($string));
}

/**
 * Given a string, strips slashes and converts all special characters to
 * their corresponding HTML entities.
 *
 * @param string String to process.
 * @param charset Character set to use, defaults to "UTF-8".
 * @return Processed string.
 */
function se($string, $charset = "UTF-8")
{
	return htmlentities(stripslashes($string), ENT_COMPAT, $charset);
}


function diemsg($msg, $desc="", $returnurl="")
{
	if (!class_exists("UI")) {
		echo "ERROR : {$msg} - {$desc}";
		exit;
	}
  $ui = new UI;
	$ui->header();
	$ui->load("err", "errorMsg.html");
	$ui->set("errorMsg", $msg);
	$ui->set("buttons", ($returnurl=="" ? "<input type=button value='BACK' onclick='history.back()'>"
		: "<input type=button value='BACK' onclick='location.replace(\"{$returnurl}\")'>"));
	$ui->show("err");
	$ui->footer("2");
	die();
}

function isemail($email)
{
	if(strstr($email, '@') && strstr($email, '.')) {
		if(eregi("^([_a-z0-9]+([\\._a-z0-9-]+)*)@([a-z0-9]{2,}(\\.[a-z0-9-]{2,})*\\.[a-z]{2,3})$", $email)){
			return true;
		}
	}
	return false;
}

/**
 * If post
 *
 * @return Boolean
 * @access public
 */
function IsPost()
{
    return ($_SERVER["REQUEST_METHOD"]=="POST");
}


function getslashes($content) {
	// $content = htmlspecialchars($content, ENT_QUOTES);
	if (!get_magic_quotes_gpc()) {
		$content = addslashes($content);
	}
	for ($i=0; $i<strlen($content); $i++) {
		$cl = substr($content, $i, 1);
		if ($cl=="'" || $cl=='"' || $cl=="<" || $cl=="/") {	 // $cl==">" ||
			$content = "";
		}
	}
	return $content;

}

function getslashes02($content) {
	$content = htmlspecialchars($content, ENT_QUOTES);
	return $content;
}


/***
 * 本機目錄檔案
 */
function chkMyFile($fp="", $dir = "./"){
  if(file_exists($dir.$fp)){
    return substr($fp,0,strcspn($fp,"."));
  }else{
    return false;
  }
}


function strtobyte($str){
  /*
  $byteArr = str_split($str);
  $byteStr = implode("",$byteArr);

 return $byteStr;
    */
  //$binary = "0x". bin2hex($str);
  return $str;
}


function setLOG($str, $keyword=""){
  global $g_log_file;

  $add_str = "
--------------------------------------------------------------------------------
  {$keyword}
--------------------------------------------------------------------------------
  {$str}";

  if( !($fp = fopen($g_log_file, "a"))){
      echo "open error";
  }else{
     fwrite ($fp, $add_str);
     fpassthru ($fp);
     fclose($fp);
  }
}


function showErr($errorMsg,$reUrl=""){
  global $ui;
  if($reUrl=="") $reUrl = "javascript:history.go(-1);";
  else $reUrl = "javascript:window.top.location.replace('{$reUrl}');";

  //if(empty($ui)){$ui = new UI;}
  //$ui->load("main","errorMsg.html");
  $tpl = array(
    "errorMsg"=>$errorMsg
    ,"btnOnClick"=>$reUrl
  );
  //$ui->header();
  //$ui->show("main");
  //$ui->footer();
  $mod = new set;
  $mod->to_html("errorMsg.html",$tpl);
  exit;
}


/**
 * 傳回之XML字串格式檢查
 * @param Objact $errors
 * @param string $title
 * @param boolean $xxxSuccessChk 是否檢查 xxxSuccess 的值
 * @return string
 * */
function chkMyXMLStr($xmlResult, $errorNote = "xmlErr", $xxxSuccessChk = ""){

  libxml_use_internal_errors(true);
  $doc = simplexml_load_string($xmlResult);
  echo $doc;
  if($doc === false)
  {
    $errors = libxml_get_errors();
    $err = $xmlResult."\n=====================================\n";
    $return = "";
    foreach($errors as $error)
	{
      $return .= str_repeat('-', $error->column) . "^\n";
      switch ($error->level)
	  {
          case LIBXML_ERR_WARNING:
              $return .= "Warning {$error->code}: ";
              break;
           case LIBXML_ERR_ERROR:
              $return .= "Error {$error->code}: ";
              break;
          case LIBXML_ERR_FATAL:
              $return .= "Fatal Error {$error->code}: ";
              break;
      }
      $return .= trim($error->message) .
                 "\n  Line: {$error->line}" .
                 "\n  Column: {$error->column}";
      if ($error->file) $return .= "\n  File: {$error->file}";
      $return .= "\n=====================================\n";
    }
    libxml_clear_errors();
    setLOG($err,$errorNote);
    showErr("Error(NO:{$errorNote})");
    exit;
  }
  elseif($xxxSuccessChk != "" && $doc->$xxxSuccessChk != "1")
  {
    setLOG($doc->message, $xxxSuccessChk.date("Y-m-d"));
    showErr("Error({$doc->message})");
    exit;
  }
  else return $doc;
}


/**
 * 檔名格式檢查
 * 限英文(大小寫)、數字、”-“(破折號)、”_”(底線)、” “(空	白)
 * @param string $fileName
 * @return boolean
 * */
function chkFileName($fileName){
  if(eregi("[^A-Za-z0-9 _\-]", $fileName)) return false;
  else return true;


}


/**
 * 判斷輸入值是否為IP
 * @return boolean
 * */
function checkIp($ip){
   if(!eregi("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$", $ip)) return FALSE;
   else return TRUE;
}


/**
 * 判斷是否為合法IP值
 * */
function checkValidIp($ip){
   if(!eregi("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$", $ip)) $return = FALSE;
   else $return = TRUE;

   $tmp = explode(".", $ip);
   if($return == TRUE){
     foreach($tmp AS $sub){
             $sub = $sub * 1;
               if($sub<0 || $sub>256) $return = FALSE;
     }
   }
   return $return;
}


/**
 * 取得 IP 位址
 * */
function getIP(){
  // No IP found (will be overwritten by for
  // if any IP is found behind a firewall)
  $ip = FALSE;

  // If HTTP_CLIENT_IP is set, then give it priority
  if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
      $ip = $_SERVER["HTTP_CLIENT_IP"];
  }

  // User is behind a proxy and check that we discard RFC1918 IP addresses
  // if they are behind a proxy then only figure out which IP belongs to the
  // user.  Might not need any more hackin if there is a squid reverse proxy
  // infront of apache.
  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

      // Put the IP's into an array which we shall work with shortly.
      $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
      if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }

      for ($i = 0; $i < count($ips); $i++) {
          // Skip RFC 1918 IP's 10.0.0.0/8, 172.16.0.0/12 and
          // 192.168.0.0/16
          if (!preg_match('/^(?:10|172\.(?:1[6-9]|2\d|3[01])|192\.168)\./', $ips[$i])) {
              if (version_compare(phpversion(), "5.0.0", ">=")) {
                  if (ip2long($ips[$i]) != false) {
                      $ip = $ips[$i];
                      break;
                  }
              } else {
                  if (ip2long($ips[$i]) != -1) {
                      $ip = $ips[$i];
                      break;
                  }
              }
          }
      }
  }

  // Return with the found IP or the remote address
  return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}




function page_bar( $pageindex , $pagecount , $totalcount ){
  global $g_myLangArr ;


      $pageNumber = $pageindex ;
      $pageSize = $pagecount ;
      $totalcount = $totalcount ;

      //分頁
      //取得總筆數
      $total_count = $totalcount;
      $Showcount = (int)$pageSize;
      //取得總頁數
      $total_page = $total_count/$Showcount;
      if($total_page >1)
      {
        //計算正確的總頁數，若有小數點則+1
        if(gettype($total_page) == "double")
        {
          $total_page = (int)$total_page + 1 ;
        }

        //若總頁數>7頁
        if($total_page >7)
        {
          //求目前頁數跟總頁數之差額
          $page_diff = $total_page - (int)$pageNumber;

          //若目前頁面為1.2.3.4，則顯示  XXX...最後頁
          if($pageNumber == "1" || $pageNumber == "2" || $pageNumber == "3" || $pageNumber == "4")
          {
            for($j=1;$j<=7;$j++)
            {
              if($j != (int)$pageNumber)
              {
              $pagedata .= "<a href=\"javascript:chgPage('".$j."')\" class=\"pagestyle\">".$j."</a>"."&nbsp;";
              }
              else
              {
                $pagedata .= $j."&nbsp;";
              }
            }
            $pagedata .= "...&nbsp;";
            $pagedata .= "<a href=\"javascript:chgPage('".$total_page."')\" class=\"pagestyle\">".$total_page."</a>"."&nbsp;";
          }
          //若為最後4頁，則顯示  1...XXX
          else if($page_diff == 0 || $page_diff == 1 || $page_diff == 2 || $page_diff == 3)
          {
            $pagedata .= "<a href=\"javascript:chgPage('1')\" class=\"pagestyle\">1</a>"."&nbsp;";
            $pagedata .= "...&nbsp;";
            for($j=$total_page-7;$j<=$total_page;$j++)
            {
              if($j != (int)$pageNumber)
              {
              $pagedata .= "<a href=\"javascript:chgPage('".$j."')\" class=\"pagestyle\">".$j."</a>"."&nbsp;";
              }
              else
              {
                $pagedata .= $j."&nbsp;";
              }
            }
          }
          //若是中間頁數，則顯示  1...XXX...最後頁
          else
          {
            $pagedata .= "<a href=\"javascript:chgPage('1')\" class=\"pagestyle\">1</a>"."&nbsp;";
            $pagedata .= "...&nbsp;";
            for($j=(int)$pageNumber-3;$j<=(int)$pageNumber+3;$j++)
            {
              if($j != (int)$pageNumber)
              {
              $pagedata .= "<a href=\"javascript:chgPage('".$j."')\" class=\"pagestyle\">".$j."</a>"."&nbsp;";
              }
              else
              {
                $pagedata .= $j."&nbsp;";
              }
            }
            $pagedata .= "...&nbsp;";
            $pagedata .= "<a href=\"javascript:chgPage('".$total_page."')\" class=\"pagestyle\">".$total_page."</a>"."&nbsp;";
          }
        }
        //若總頁數<7
        else
        {
          //顯示， XXXX
          for($j=1;$j<=$total_page;$j++)
          {
            if($j != (int)$pageNumber)
            {
            $pagedata .= "<a href=\"javascript:chgPage('".$j."')\" class=\"pagestyle\">".$j."</a>"."&nbsp;";
            }
            else
            {
              $pagedata .= $j."&nbsp;";
            }
          }
        }
        //20140812 測試項目
        $pagedata .= "&nbsp;&nbsp;<input type=\"text\" name=\"page_num\" id=\"page_num\" size=\"3\" onkeypress=\"javascript:if(window.event.keyCode==13){chgPage(this.value)}\">&nbsp;".$g_myLangArr["page"]."";
        //  目前頁數/總頁數
        $pagedetail = $pageNumber."/".$total_page;

        $pagebar = "<div align=\"center\">{$pagedata} {$pagedetail}</div>";

      }else{
        $pagebar = '' ;
        $pagedetail = '' ;
      }



      return array('pagebar'=> $pagebar ,  'pagedetail' => $pagedetail  ) ;



}
