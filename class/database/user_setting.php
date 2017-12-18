<?php
class UserSetting
{
	private $database,$table,$tables;
	
	function __construct($database_connection,$pdodatabse_referance) {
		$this->database = $database_connection;
		$this->table = "user_setting";
		$this->tables = $pdodatabse_referance;
	}
	
	function updateUserSettingByUserId($uid, $arr) {
		try {
			if ($arr["unlock_ip"] == NULL) $arr["unlock_ip"] = 0;
			$has = $this->getUserSettingByUserId($uid);
			if (!empty($has)) {
				$values = array($arr["unlock_ip"], $uid);
				$q=$this->database->prepare("UPDATE ".$this->table." SET unlock_ip=? WHERE user_id=?");
			} else {
				$values = array($uid, $arr["unlock_ip"]);
				$q=$this->database->prepare("INSERT INTO ".$this->table." (user_id,unlock_ip) VALUES (?,?)");
			}
			
			$r=$q->execute($values);
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function getUserSettingByUserId($uid) {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table." WHERE user_id=?");
			$r=$q->execute(array($uid));
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
}
?>
