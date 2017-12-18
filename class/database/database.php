<?php
/*require_once 'announcement.php';
require_once 'setting.php';
require_once 'user.php';
require_once 'user_setting.php';
require_once 'DB.php';*/

class Database
{
	private  $database;

	var $user;

	function __construct() {
		global $config;
		try {
			$this->database = new PDO("mssql:dbname=moci;host=59.124.153.40\\SQLEXPRESS,186;charset=utf8", 'moci', 'moci');
			$this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->database->exec("set names utf8");

			// init all classes
			/*$this->canned_message = new CannedMessage($this->database, $this);
			$this->document = new Document($this->database, $this);
			$this->failedLoginAttempts = new FailedLoginAttempts($this->database, $this);
			$this->message = new Message($this->database, $this);
			$this->message_status = new MessageStatus($this->database, $this);
			$this->order = new Order($this->database, $this);
			$this->announcement = new Announcement($this->database, $this);
			$this->setting = new Setting($this->database, $this);
			$this->user = new User($this->database, $this);
			$this->user_setting = new UserSetting($this->database, $this);*/
			$this->DB = new DB($this->database, $this);

		} catch(PDOException $e) {
			echo $e->getMessage()." - PDO error";
		} catch(Exception $e) {
			echo $e->getMessage()." - General error";
		}
	}
}

$database = new Database();

?>
