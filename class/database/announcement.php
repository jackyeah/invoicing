<?php
class Announcement
{
	private $database,$table,$tables;
	
	function __construct($database_connection,$pdodatabse_referance) {
		$this->database = $database_connection;
		$this->table = "announcement";
		$this->tables = $pdodatabse_referance;
	}
	
	/*function updateSetting($arr) {
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
	}*/
	
	function getAnnData() {
		try {
			$q=$this->database->prepare("SELECT * FROM ".$this->table);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
}
?>
