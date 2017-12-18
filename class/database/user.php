<?php
class User
{
	private $database,$table,$tables;
	
	function __construct($database_connection,$pdodatabse_referance) {
		$this->database = $database_connection;
		$this->table = "user";
		$this->tables = $pdodatabse_referance;
	}
	
	function addUpdateUser($arr) {
		try {
			$has = $this->getUserByUserid($arr["user_id"]);
			if (!empty($has)) {
				$values = array($arr["username"], $arr["password"], $arr["first_name"], $arr["last_name"],
						$arr["email"], $arr["user_level"], $arr["is_active"], $arr["signature"], $arr["user_id"]);
				$q=$this->database->prepare("UPDATE ".$this->table."
											SET username=?,password=?,first_name=?,last_name=?,
												email=?,user_level=?,is_active=?,signature=?
												WHERE user_id=?");
				$r=$q->execute($values);
				$user_id = $arr["user_id"];
			} else {
				$values = array($arr["username"], $arr["password"], $arr["first_name"], $arr["last_name"],
						$arr["email"], $arr["user_level"], $arr["is_active"], $arr["signature"]
				);
				$q=$this->database->prepare("INSERT INTO ".$this->table." (
												username,password,first_name,last_name,
												email,user_level,is_active,signature
											) VALUES (?,?,?,?,
													?,?,?,?)");
	
				$r=$q->execute($values);
				$user_id = $this->database->lastInsertId();
			}
			
			//add user setting
			if ($r && $arr["user_level"] != CUSTOMER_LEVEL) {
				$this->tables->user_setting->updateUserSettingByUserId($user_id, $arr["user_setting"]);
			}
				
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function updateUserIsDeleted($uid) {
		try {
			$q=$this->database->prepare("UPDATE ".$this->table." SET is_deleted=1 WHERE user_id=?");
			$r=$q->execute(array($uid));
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function updateUniqueFieldByUserId($column, $value, $user_id) {
		try {
			$q=$this->database->prepare("UPDATE ".$this->table." SET ".$column."=? WHERE user_id=?");
			$r=$q->execute(array($value, $user_id));
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserByUserid($uid) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE user_id=? ");
			$r=$q->execute(array($uid));
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserNameByUserid($uid) {
		try {
			$q=$this->database->prepare("SELECT first_name,last_name FROM ".$this->table." WHERE user_id=? ");
			$r=$q->execute(array($uid));
			$r=$q->fetch();
			$return = $r["first_name"]." ".$r["last_name"];
			return $return;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// Only for login
	function getUserByUnameAndPassword($uname, $pwd) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE username=? AND password=? AND user_status='1'");
			$r=$q->execute(array($uname, $pwd));
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserByUname($uname) {
		try {
			$q=$this->database->prepare("SELECT user_id FROM ".$this->table." WHERE username=?");
			$r=$q->execute(array($uname));
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserByUnameAndNotDelete($uname) {
		try {
			$q=$this->database->prepare("SELECT user_id FROM ".$this->table." WHERE username=? AND is_deleted=0");
			$r=$q->execute(array($uname));
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserByEmail($email) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE email=?");
			$r=$q->execute(array($email));
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserByUseridAndActive($uid) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE user_id=? AND is_deleted=0 AND is_active=1");
			$r=$q->execute(array($uid));
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserByUseridAndNotDelete($uid) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE user_id=? AND is_deleted=0");
			$r=$q->execute(array($uid));
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserManageTable($user_level, $search, $sort) {
		try {
			$sql = "SELECT * FROM ".$this->table." WHERE is_deleted=? ";
			if ($user_level > 0) $sql .= " AND user_level=".$user_level;
			if ($search != "") {
				$sql .= " AND (first_name LIKE '%".$search."%' ";
				$sql .= " OR last_name LIKE '%".$search."%' ";
				$sql .= " OR email LIKE '%".$search."%') ";
			}
			if ($sort == "first_name") $sql .= " ORDER BY first_name ASC";
			else if ($sort == "create_date") $sql .= " ORDER BY create_date DESC";
				
			$q=$this->database->prepare($sql);
			$r=$q->execute(array(0));
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function checkDupsEmail($email, $uid) {
		try {
			$q=$this->database->prepare("SELECT email FROM ".$this->table.
					" WHERE email=? AND is_deleted=0 AND user_id!=?");
			$r=$q->execute(array(trim($email), $uid));
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	function checkDupsUsername($username, $uid) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table.
					" WHERE username=? AND is_deleted=0 AND user_id!=?");
			$r=$q->execute(array(trim($username), $uid));
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getAllStaff() {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE is_deleted=0");
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	function getAllStaffInfo() {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			$return = array();
			foreach ($r as $value) {
				$uid = $value["user_id"];
				$return[$uid]["first_name"] = $value["first_name"];
				$return[$uid]["last_name"] = $value["last_name"];
				$return[$uid]["user_level"] = $value["user_level"];
			}
			return $return;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
// by Jacky
	
	function addUser($condition_user,$condition_FTab,$condition_manage,$PageType,$UID) {
		try {
			// Add User
			if($PageType == "A"){
				// Add User Infomation
				$ConditionArray = json_decode($condition_user);
				$SqlColumn = "";
				$SqlValue = "";
				foreach($ConditionArray -> data as $v)
				{
					$SQLcondition = $v->Column;
					$SQLvalue = $v->Value;
				
					$SqlColumn .= $SQLcondition.",";
					
					if($SQLcondition == "password"){
						$SQLvalue = md5($SQLvalue );
					}
					$SqlValue .= "'".$SQLvalue."',";
				}
				if (substr($SqlColumn,-1) == ","){ $SqlColumn = substr($SqlColumn, 0, strlen($SqlColumn)-1); }
				if (substr($SqlValue,-1) == ","){ $SqlValue = substr($SqlValue, 0, strlen($SqlValue)-1); }
				$SqlString = "INSERT INTO user (".$SqlColumn.") VALUES (".$SqlValue.")";
				
				$q=$this->database->prepare($SqlString);
				$UserResult=$q->execute(array());
				$LastInsertID = $this->database->lastInsertId();
				
				// Add User Competence List Menu
				$ConditionArray = json_decode($condition_FTab);
				$SqlSubString = "";
				foreach($ConditionArray -> data as $v)
				{
					$SQLValue1 = $v->Value1;
					$SQLValue2 = $v->Value2;
					
					$SqlSubString .= "('".$LastInsertID."','".$SQLValue1."','".$SQLValue2."','M'),";
				}
				if (substr($SqlSubString,-1) == ","){ $SqlSubString = substr($SqlSubString, 0, strlen($SqlSubString)-1); }
				$SqlString = "INSERT INTO competence_list (user,competence,enabled,type) VALUES ".$SqlSubString;
				$q=$this->database->prepare($SqlString);
				$MenuResult=$q->execute(array());
				
				// Add User Competence List Manage
				$ConditionArray = json_decode($condition_manage);
				$SqlSubString = "";
				foreach($ConditionArray -> data as $v)
				{
					$SQLValue1 = $v->Value1;
					$SQLValue2 = $v->Value2;
					$SQLValue3 = $v->Value3;
					
					$SqlSubString .= "('".$LastInsertID."','".$SQLValue1."','".$SQLValue2."','".$SQLValue3."'),";
				}
				if (substr($SqlSubString,-1) == ","){ $SqlSubString = substr($SqlSubString, 0, strlen($SqlSubString)-1); }
				$SqlString = "INSERT INTO competence_list (user,competence,enabled,type) VALUES ".$SqlSubString;
				$q=$this->database->prepare($SqlString);
				$ManageResult=$q->execute(array());
				if($ManageResult){
					return $LastInsertID;
				}
				else{
					return "Add Error";
				}
				//return $ManageResult;
			}
			
			// Modify User
			else if($PageType == "U"){
				// Modify User Infomation
				$ConditionArray = json_decode($condition_user);
				$SqlStr = "";
				foreach($ConditionArray -> data as $v)
				{
					$SQLcondition = $v->Column;
					$SQLvalue = $v->Value;
					if($SQLcondition == "password"){
						if($SQLvalue != ""){
							$SQLvalue = md5($SQLvalue);
							
							$SqlStr .= $SQLcondition."= '".$SQLvalue."',";
						}
					}
					else{
						$SqlStr .= $SQLcondition."= '".$SQLvalue."',";
					}
					
				}
				if (substr($SqlStr,-1) == ","){ $SqlStr = substr($SqlStr, 0, strlen($SqlStr)-1); }
				$SqlString = "UPDATE user SET ".$SqlStr." WHERE user_id = '".$UID."'";
				
				$q=$this->database->prepare($SqlString);
				$UserResult=$q->execute(array());
				
				// Modify User Competence List Menu
				$ConditionArray = json_decode($condition_FTab);
				$SqlSubString = "";
				foreach($ConditionArray -> data as $v)
				{
					$SQLValue1 = $v->Value1;
					$SQLValue2 = $v->Value2;
					
					$SqlString = "UPDATE competence_list SET enabled = '".$SQLValue2."' WHERE user = '".$UID."' AND competence = '".$SQLValue1."' AND type='M'";
					$q=$this->database->prepare($SqlString);
					$MenuResult=$q->execute(array());
				}
				
				// Modify User Competence List Manage
				$ConditionArray = json_decode($condition_manage);
				$SqlSubString = "";
				foreach($ConditionArray -> data as $v)
				{
					$SQLValue1 = $v->Value1;
					$SQLValue2 = $v->Value2;
					$SQLValue3 = $v->Value3;
					
					$SqlString = "UPDATE competence_list SET enabled = '".$SQLValue2."' WHERE user = '".$UID."' AND competence = '".$SQLValue1."' AND type='".$SQLValue3."'";
					$q=$this->database->prepare($SqlString);
					$MenuResult=$q->execute(array());
				}
				return $MenuResult;
				
			}
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function updateUserSessionid($sessid,$uid){
		try {
			$q = $this->database->prepare("UPDATE ".$this->table." SET session_id =? WHERE user_id=?");
			$r=$q->execute(array($sessid,$uid));
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function updateUserLoginTime($uid){
		try {
			$q = $this->database->prepare("UPDATE ".$this->table." SET last_login_time= NOW()  WHERE user_id=?");
			$r=$q->execute(array($uid));
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserSessionid($uid) {
		try {
			$q=$this->database->prepare("SELECT session_id FROM ".$this->table." WHERE user_id=?");
			$r=$q->execute(array($uid));
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// Parmar $PageData        => ($StartNo,$PageCount)
	function getAllUserData($PageData) {
		try {
			if(isset($PageData)){
				$PageDataArray = explode(",",$PageData);
				$StartNo = $PageDataArray[0];
				$Count = $PageDataArray[1];
			
				$PageString = " LIMIT ".$StartNo.",".$Count;
			}
			
			$q=$this->database->prepare("SELECT * FROM ".$this->table.$PageString);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getAllUserCount() {
		try {
			$q=$this->database->prepare("SELECT count(*) FROM ".$this->table);
			$r=$q->execute(array());
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// Parmar $conditionAND => Search by AND 
	// Parmar $conditionOR   => Search by OR (user_company = '1' OR user_company = '2' user_company = '3')
	// Parmar $conditionLIKE => Search by LIKE (first_name LIKE '%xxx%' OR last_name LIKE '%xxx%')
	// Parmar $PageData        => ($StartNo,$PageCount)
	function getAllUserDataBySthing($conditionAND,$conditionOR,$conditionLIKE,$PageData) {
		try {
			$ConditionArray = json_decode($conditionAND);
			$ConditionString = "";
			$PageString = "";
			foreach($ConditionArray -> data as $val)
			{
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionString .= $SQLcondition."='".$SQLvalue."' AND ";
			}
			
			$ConditionArray = json_decode($conditionOR);
			$aaa = "1";
			$ConditionStringOR = "";
			foreach($ConditionArray -> data as $val)
			{
				$aaa = "2";
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionStringOR .= $SQLcondition."='".$SQLvalue."' OR ";
			}
			if($aaa == "2"){
				if (substr($ConditionStringOR,-3) == "OR "){ $ConditionStringOR = substr($ConditionStringOR, 0, strlen($ConditionStringOR)-3); }

				$ConditionString .= "(".$ConditionStringOR.") AND ";
			}
			
			$ConditionArray = json_decode($conditionLIKE);
			$aaa = "1";
			$ConditionStringLIKE = "";
			foreach($ConditionArray -> data as $val)
			{
				$aaa = "2";
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionStringLIKE .= $SQLcondition." LIKE '%".$SQLvalue."%' OR ";
			}
			if($aaa == "2"){
				if (substr($ConditionStringLIKE,-3) == "OR "){ $ConditionStringLIKE = substr($ConditionStringLIKE, 0, strlen($ConditionStringLIKE)-3); }

				$ConditionString .= "(".$ConditionStringLIKE.") AND ";
			}
			if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
			if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
			
			if(isset($PageData)){
				$PageDataArray = explode(",",$PageData);
				$StartNo = $PageDataArray[0];
				$Count = $PageDataArray[1];
				
				$PageString = " LIMIT ".$StartNo.",".$Count;
			}
			
			$sqlString = "SELECT * FROM ".$this->table." WHERE ".$ConditionString.$PageString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// Parmar $conditionAND => Search by AND 
	// Parmar $conditionOR   => Search by OR (user_company = '1' OR user_company = '2' user_company = '3')
	// Parmar $conditionLIKE => Search by LIKE (first_name LIKE '%xxx%' OR last_name LIKE '%xxx%')
	function getAllUserCountBySthing($conditionAND,$conditionOR,$conditionLIKE) {
		try {
			$ConditionArray = json_decode($conditionAND);
			$ConditionString = "";
			$PageString = "";
			foreach($ConditionArray -> data as $val)
			{
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionString .= $SQLcondition."='".$SQLvalue."' AND ";
			}
			
			$ConditionArray = json_decode($conditionOR);
			$aaa = "1";
			$ConditionStringOR = "";
			foreach($ConditionArray -> data as $val)
			{
				$aaa = "2";
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionStringOR .= $SQLcondition."='".$SQLvalue."' OR ";
			}
			if($aaa == "2"){
				if (substr($ConditionStringOR,-3) == "OR "){ $ConditionStringOR = substr($ConditionStringOR, 0, strlen($ConditionStringOR)-3); }

				$ConditionString .= "(".$ConditionStringOR.") AND ";
			}
			
			$ConditionArray = json_decode($conditionLIKE);
			$aaa = "1";
			$ConditionStringLIKE = "";
			foreach($ConditionArray -> data as $val)
			{
				$aaa = "2";
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionStringLIKE .= $SQLcondition." LIKE '%".$SQLvalue."%' OR ";
			}
			if($aaa == "2"){
				if (substr($ConditionStringLIKE,-3) == "OR "){ $ConditionStringLIKE = substr($ConditionStringLIKE, 0, strlen($ConditionStringLIKE)-3); }

				$ConditionString .= "(".$ConditionStringLIKE.") AND ";
			}
			if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
			if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
			
			$sqlString = "SELECT count(*) FROM ".$this->table." WHERE ".$ConditionString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getOneUserDataBySthing($condition) {
		try {
			$ConditionArray = json_decode($condition);
			$ConditionString = "";
			foreach($ConditionArray -> data as $val)
			{
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionString .= $SQLcondition."='".$SQLvalue."' ";
			}
			$sqlString = "SELECT * FROM ".$this->table." WHERE ".$ConditionString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getLocationCompany() {
		try {
			$q=$this->database->prepare("SELECT * FROM competence_option WHERE type = 'C'");
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
}
?>
