<?php
class Setting
{
	private $database,$table,$tables;
	
	function __construct($database_connection,$pdodatabse_referance) {
		$this->database = $database_connection;
		$this->table = "setting";
		$this->tables = $pdodatabse_referance;
	}
	
	function updateSetting($arr) {
		try {
			$values = array($arr["imap_mail_1"], $arr["imap_pass_1"], $arr["imap_start_date1"],
						$arr["imap_mail_2"], $arr["imap_pass_2"], $arr["imap_start_date2"], 
						$arr["allow_ip"], $arr["system_title"]);
			$q=$this->database->prepare("UPDATE ".$this->table."
										SET imap_mail_1=?,imap_pass_1=?,imap_start_date1=?,
											imap_mail_2=?,imap_pass_2=?,imap_start_date2=?,
											allow_ip=?,system_title=?
										WHERE setting_id=1");
			$r=$q->execute($values);
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getSetting() {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE setting_id=1");
			$r=$q->execute(array());
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getSettingField($field) {
		try {
			$q=$this->database->prepare("SELECT ".$field." FROM ".$this->table." WHERE setting_id=1");
			$r=$q->execute(array());
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// by Jacky
	
	function getCompetenceData($condition,$DISTINCT,$column) {
		try {
			$ConditionArray = json_decode($condition);
			$SqlString = "";
			foreach($ConditionArray -> data as $v)
			{
				$SQLcondition = $v->condition;
				$SQLvalue = $v->value;
			
				$ConditionString .= $SQLcondition."='".$SQLvalue."' AND ";
			}
			if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
			
			// for distinct format
			if($DISTINCT == ""){
				if($column == ""){
					$sqlString = "SELECT * FROM competence_option WHERE ".$ConditionString;
				}
				else{
					$sqlString = "SELECT ".$column." FROM competence_option WHERE ".$ConditionString;
				}
			}
			else{
				$sqlString = "SELECT DISTINCT ".$DISTINCT." FROM competence_option WHERE ".$ConditionString;
			}
			//return $sqlString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getCompetence($SqlString) {
		try {
			//return $sqlString;
			$q=$this->database->prepare($SqlString);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getAllUserCompetence($condition) {
		try {
			$ConditionArray = json_decode($condition);
			$ConditionString = "";
			foreach($ConditionArray -> data as $val)
			{
				$SQLcondition = $val->Column;
				$SQLvalue = $val->Value;
			
				$ConditionString .= $SQLcondition."='".$SQLvalue."' AND ";
			}
			if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
			$sqlString = "SELECT * FROM competence_list WHERE ".$ConditionString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
}
?>
