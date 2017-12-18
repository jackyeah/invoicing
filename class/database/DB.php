<?php
class DB
{
	private $database,$table,$tables;
	
	function __construct($database_connection,$pdodatabse_referance) {
		$this->database = $database_connection;
		$this->table = "user_setting";
		$this->tables = $pdodatabse_referance;
	}
	
	function GetInsertID(){
		$LastInsertID = $this->database->lastInsertId();
		return $LastInsertID;
	}
	
	function InsertOneData($TableName,$condition){
		$ConditionArray = json_decode($condition);
		$SqlColumn = "";
		$SqlValue = "";
		foreach($ConditionArray -> data as $v)
		{
			$SQLcondition = $v->Column;
			$SQLvalue = $v->Value;
		
			$SqlColumn .= $SQLcondition.",";
			$SqlValue .= "'".$SQLvalue."',";
		}
		if (substr($SqlColumn,-1) == ","){ $SqlColumn = substr($SqlColumn, 0, strlen($SqlColumn)-1); }
		if (substr($SqlValue,-1) == ","){ $SqlValue = substr($SqlValue, 0, strlen($SqlValue)-1); }
		$SqlString = "INSERT INTO ".$TableName." (".$SqlColumn.") VALUES (".$SqlValue.")";
		//return $SqlString;
		$q=$this->database->prepare($SqlString);
		$r=$q->execute(array());
		$LastInsertID = $this->database->lastInsertId();
		return $LastInsertID;
	}
	
	function InsertDatas($TableName,$Column,$condition){
		//Compose column
		$ColumnStr = "";
		$ColumnArray = explode(",", $Column);
		for($i=0; $i<count($ColumnArray); $i++){
			$ColumnStr .= $ColumnArray[$i].",";
		}
		if (substr($ColumnStr,-1) == ","){ $ColumnStr = substr($ColumnStr, 0, strlen($ColumnStr)-1); }
		
		// Compose condition
		$ConditionArray = json_decode($condition);
		$SqlSubString = "";
		foreach($ConditionArray -> data as $v)
		{
			$SQLValue = $v->Value;
			
			$SQLValueArray = explode(",", $SQLValue);
			$SQLValueDetail = "";
			for($i=0; $i<count($SQLValueArray); $i++){
				$SQLValueDetail .= "'".$SQLValueArray[$i]."',";
			}
			if (substr($SQLValueDetail,-1) == ","){ $SQLValueDetail = substr($SQLValueDetail, 0, strlen($SQLValueDetail)-1); }
			$SqlSubString .= "(".$SQLValueDetail."),";
		}
		if (substr($SqlSubString,-1) == ","){ $SqlSubString = substr($SqlSubString, 0, strlen($SqlSubString)-1); }
		$SqlString = "INSERT INTO ".$TableName." (".$ColumnStr.") VALUES ".$SqlSubString;
		$q=$this->database->prepare($SqlString);
		$r=$q->execute(array());
		return $r;
		//return $SqlString;
	}
	
	// Updata Data
	// Parmar $TableName              => Search Table
	// Parmar $conditionSET           => The information shoud be modify
	// Parmar $conditionAND          => Search by AND
	// Parmar $conditionOR            => Search by OR
	//                                                     {"data":[{"Column":"user_company","Value":"1,2,3"},{"Column":"user_status","Value":"1,2"}]}
	//                                                      (user_company = '1' OR user_company = '2' OR user_company = '3') AND (user_status = '1' OR user_status = '2')
	function UpdateData($TableName,$conditionSET,$conditionAND,$conditionOR){
		try {
			$ConditionString = "";
			$SetStr = $this->ComposeSET($conditionSET);
			$StringAND = $this->ComposeAND($conditionAND);
			$StringOR = $this->ComposeOR($conditionOR);
			
			if($StringAND != "" && $StringOR != ""){ $StringOR = "AND ".$StringOR; }
			$ConditionString = $StringAND.$StringOR;
			if($ConditionString != ""){ $ConditionString = " WHERE ".$ConditionString; }
			$SqlString = "UPDATE ".$TableName." SET ".$SetStr.$ConditionString;
			//return $SqlString;
			$q=$this->database->prepare($SqlString);
			$r=$q->execute(array());
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function UpdDataBySQL($SqlString){
		try {
			$q=$this->database->prepare($SqlString);
			$r=$q->execute(array());
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	//Get One Data
	function GetOneData($TableName,$conditionAND){
		try {
			$ConditionString = "";
			$StringAND = $this->ComposeAND($conditionAND);
			if($StringAND != ""){ $ConditionString = " WHERE ".$StringAND; }
			$sqlString = "SELECT * FROM ".$TableName.$ConditionString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function Test(){
		return "123";
	}
	
	function DelDatas($TableName,$conditionAND,$conditionOR){
			$ConditionString = "";
			$StringAND = $this->ComposeAND($conditionAND);
			$StringOR = $this->ComposeOR($conditionOR);
			
			if($StringAND != "" && $StringOR != ""){ $StringOR = "AND ".$StringOR; }
			$ConditionString = $StringAND.$StringOR;
			if($ConditionString != ""){ $ConditionString = " WHERE ".$ConditionString; }
			$SqlString = "Delete From ".$TableName.$ConditionString;
			//return $SqlString;
			$q=$this->database->prepare($SqlString);
			$r=$q->execute(array());
			return $r;
	}
	
	// Get All Data
	// Parmar $TableName              => Search Table
	// Parmar $conditionAND          => Search by AND
	// Parmar $conditionOR            => Search by OR
	//                                                     {"data":[{"Column":"user_company","Value":"1,2,3"},{"Column":"user_status","Value":"1,2"}]}
	//                                                      (user_company = '1' OR user_company = '2' OR user_company = '3') AND (user_status = '1' OR user_status = '2') 
	// Parmar $conditionLIKE          => Search by LIKE (first_name LIKE '%xxx%' OR last_name LIKE '%xxx%')
	// Parmar $conditionORDERBY => Search by LIKE (first_name LIKE '%xxx%' OR last_name LIKE '%xxx%')
	// Parmar $PageData                => ($StartNo,$PageCount)
	function GetDatas($TableName,$conditionAND,$conditionOR,$conditionLIKE,$conditionORDERBY,$PageData){
		try {
			$ConditionString = "";
			$PageString = "";
			$OrderByString = "";
			
			$StringAND = $this->ComposeAND($conditionAND);
			$StringOR = $this->ComposeOR($conditionOR);
			$StringLIKE = $this->ComposeLIKE($conditionLIKE);
			
			if($StringAND != "" && $StringOR != ""){ $StringOR = "AND ".$StringOR; }
			$ConditionString = $StringAND.$StringOR;
			if($ConditionString != "" && $StringLIKE != ""){ $StringLIKE = "AND ".$StringLIKE; }
			$ConditionString .= $StringLIKE;
			if($ConditionString != ""){ $ConditionString = "WHERE ".$ConditionString; }
			
			$OrderByString = $this->ComposeOrderBy($conditionORDERBY);
			
			$PageString = $this->ComposePage($PageData);
			
			$sqlString = "SELECT * FROM ".$TableName." ".$ConditionString.$OrderByString.$PageString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetchAll();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// Get All count without limit
	// Parmar $TableName              => Search Table
	// Parmar $conditionAND          => Search by AND
	// Parmar $conditionOR            => Search by OR (user_company = '1' OR user_company = '2' user_company = '3')
	// Parmar $conditionLIKE          => Search by LIKE (first_name LIKE '%xxx%' OR last_name LIKE '%xxx%')
	// Parmar $conditionORDERBY => Search by LIKE (first_name LIKE '%xxx%' OR last_name LIKE '%xxx%')
	function GetDatasCount($TableName,$conditionAND,$conditionOR,$conditionLIKE,$conditionORDERBY){
		try {
			$ConditionString = "";
			$PageString = "";
			$OrderByString = "";
			
			$StringAND = $this->ComposeAND($conditionAND);
			$StringOR = $this->ComposeOR($conditionOR);
			$StringLIKE = $this->ComposeLIKE($conditionLIKE);
			
			if($StringAND != "" && $StringOR != ""){ $StringOR = "AND ".$StringOR; }
			$ConditionString = $StringAND.$StringOR;
			if($ConditionString != "" && $StringLIKE != ""){ $StringLIKE = "AND ".$StringLIKE; }
			$ConditionString .= $StringLIKE;
			if($ConditionString != ""){ $ConditionString = "WHERE ".$ConditionString; }
			
			$OrderByString = $this->ComposeOrderBy($conditionORDERBY);
			
			$sqlString = "SELECT count(*) FROM ".$TableName." ".$ConditionString.$OrderByString;
			$q=$this->database->prepare($sqlString);
			$r=$q->execute(array());
			$r=$q->fetchColumn();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	function GetDataBySQL($SqlString){
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
	
	function GetOneDataBySQL($SqlString){
		try {
			//return $sqlString;
			$q=$this->database->prepare($SqlString);
			$r=$q->execute(array());
			$r=$q->fetch();
			return $r;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	// Compose AND SQL
	function ComposeAND($String){
		$ConditionArray = json_decode($String);
		$ConditionString = "";
		foreach($ConditionArray -> data as $val)
		{
			$SQLcondition = $val->Column;
			$SQLvalue = $val->Value;
				
			$ConditionString .= $SQLcondition."='".$SQLvalue."' AND ";
		}
		if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
		return $ConditionString;
	}
	
	// Compose OR SQL
	function ComposeOR($String){
		$ConditionArray = json_decode($String);
		$ConditionString = "";
		foreach($ConditionArray -> data as $val)
		{
			$SQLcondition = $val->Column;
			$SQLvalue = $val->Value;
			$SQLvalueArray = explode(",",$SQLvalue);
			$ConditionString .= " (";
			for($i=0; $i<count($SQLvalueArray); $i++){
				$ConditionString .= $SQLcondition."='".$SQLvalueArray[$i]."' OR ";
			}
			if($ConditionString != ""){
				if (substr($ConditionString,-3) == "OR "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-3); }
				$ConditionString .= ") AND ";
			}
		}
		if (substr($ConditionString,-4) == "AND "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-4); }
		
		return $ConditionString;
	
	}
	
	// Compose LIKE SQL
	function ComposeLIKE($String){
		$ConditionArray = json_decode($String);
		$ConditionString = "";
		foreach($ConditionArray -> data as $val)
		{
			$SQLcondition = $val->Column;
			$SQLvalue = $val->Value;
		
			$ConditionString .= $SQLcondition." LIKE '%".$SQLvalue."%' OR ";
		}
		if($ConditionString != ""){
			if (substr($ConditionString,-3) == "OR "){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-3); }
			$ConditionString = "(".$ConditionString.") ";
		}
		return $ConditionString;
	}
	
	// Compose ORDER BY SQL
	function ComposeOrderBy($String){
		$OrderByString = "";
		if($String != ""){
			$OrderByArray = explode(",",$String);
			for($i=0; $i<count($OrderByArray); $i++){
				$OrderByString .= $OrderByArray[$i]." ,";
			}
		}
		if($OrderByString != ""){
			if (substr($OrderByString,-1) == ","){ $OrderByString = substr($OrderByString, 0, strlen($OrderByString)-1); }
			$OrderByString = " ORDER BY ".$OrderByString;
		}
		return $OrderByString;
	}
	
	// Compose LIMIT SQL
	function ComposePage($String){
		$PageString = "";
		if($String != ""){
			$PageDataArray = explode(",",$String);
			$StartNo = $PageDataArray[0];
			$Count = $PageDataArray[1];
			
			$PageString = " LIMIT ".$StartNo.",".$Count;
		}
		return $PageString;
	}
	
	// Compose SET SQL
	function ComposeSET($String){
		$ConditionArray = json_decode($String);
		$ConditionString = "";
		foreach($ConditionArray -> data as $val)
		{
			$SQLcondition = $val->Column;
			$SQLvalue = $val->Value;
				
			$ConditionString .= $SQLcondition."='".$SQLvalue."',";
		}
		if (substr($ConditionString,-1) == ","){ $ConditionString = substr($ConditionString, 0, strlen($ConditionString)-1); }
		return $ConditionString;
	}
}
?>
