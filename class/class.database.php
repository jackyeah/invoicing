<?php
class mssqlClass{
	function Query($query){
		$serverName = "59.124.153.40\\SQLEXPRESS,186";
		$connectionInfo = array( "Database"=>"moci", "UID"=>"moci", "PWD"=>"moci", "CharacterSet" => "UTF-8");
		$Data = array();
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn ) {
		    $result = sqlsrv_query($conn, $query);
		    if($result == false) {
		    	$Data['success'] = "0";
		    	$Data['msg'] = sqlsrv_errors();
		    }else{
		        $result = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		    	$Data['success'] = "1";
		    	$Data['msg'] = "";
		    	$Data['row'] = $result;
		    }

		}else{
		    $Data['success'] = "-1";
		    $Data['msg'] = sqlsrv_errors();
		}
		sqlsrv_close($conn);
		return $Data;
	}

	function QueryAndGetID($query){
		$query .= "SELECT @@identity AS id";
		$serverName = "59.124.153.40\\SQLEXPRESS,186";
		$connectionInfo = array( "Database"=>"moci", "UID"=>"moci", "PWD"=>"moci", "CharacterSet" => "UTF-8");
		$Data = array();
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn ) {
		    $result = sqlsrv_query($conn, $query);
		    if($result == false) {
		    	$Data['success'] = "0";
		    	$Data['msg'] = sqlsrv_errors();
		    }else{
		    	sqlsrv_next_result($result);
				sqlsrv_fetch($result);
		        //$result = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		    	$Data['success'] = "1";
		    	$Data['msg'] = sqlsrv_get_field($result, 0);
		    	$Data['row'] = "";
		    }

		}else{
		    $Data['success'] = "-1";
		    $Data['msg'] = sqlsrv_errors();
		}
		sqlsrv_close($conn);
		return $Data;
	}

	function QueryList($query){
		$serverName = "59.124.153.40\\SQLEXPRESS,186";
		$connectionInfo = array( "Database"=>"moci", "UID"=>"moci", "PWD"=>"moci", "CharacterSet" => "UTF-8");
		$Data = array();
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn ) {
		    $result = sqlsrv_query($conn, $query);
		    if($result == false) {
		    	$Data['success'] = "0";
		    	$Data['msg'] = sqlsrv_errors();
		    }else{
		    	$Data['success'] = "1";
		    	$Data['msg'] = "";
		    	$array = array();
		    	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)){
		    		$array[] = $row;
		    	}
		    	$Data['row'] = $array;
		    }

		}else{
		    $Data['success'] = "-1";
		    $Data['msg'] = sqlsrv_errors();
		}
		sqlsrv_close($conn);
		return $Data;
	}


}
/*
*/
?>