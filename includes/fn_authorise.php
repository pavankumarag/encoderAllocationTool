<?php

/*		INCLUDE FILE:   fn_authorise.php
*
*		folder:			includes/
*
*		used in:        index.php
*
*		version:    	0901   date: 2010-07-01
*
*		purpose:		test $username, $password for authorisation
*
*	===========================================================================
*/		
	function userAuthorised($username, $password) {

			$md5Password = md5($password);
			$tUser_SQLselect = "SELECT ID, password, accessLevel FROM eUser ";
			$tUser_SQLselect .= "WHERE username = '".$username."' ";	

			$tUser_SQLselect_Query = mysql_query($tUser_SQLselect); 	
			while ($row = mysql_fetch_array($tUser_SQLselect_Query, MYSQL_ASSOC)) {
			    $userID = $row['ID'];
			    $passwordRetrieved = $row['password'];
			    $accessLevel = $row['accessLevel'];
			}
		
			mysql_free_result($tUser_SQLselect_Query);
						
			if (!empty($passwordRetrieved) AND ($md5Password == $passwordRetrieved)) {
	
					setcookie("accessLevel", $accessLevel, time()+7200, "/");	
					setcookie("userID", $userID, time()+7200, "/");	
					setcookie("loginAuthorised", "loginAuthorised", time()+7200, "/");
					$returnCode = true;
					
					$sessionLogged = insertLogin($userID,$username);
					if (!$sessionLogged) {
						setcookie("sessionLogging", "failed", time()+300, "/");
					}				
			} else {
				$returnCode = false;			
			}
			
		return $returnCode;
	}


	function insertLogin($userID, $username) {
		$success = false;
		//	Get current date-time in MySQL format
		date_default_timezone_set('GMT');
		$nowTimeStamp = date("Y-m-d H:i:s");
		//	Get user's IP address
		$userIP = $_SERVER['REMOTE_ADDR'];
	
		$insertLogin_SQL = 'INSERT INTO eAccessLog (
										userID, 
										timeLogin, 
										IPaddress,
										userName
									) VALUES (
										'.$userID.',
										"'.$nowTimeStamp.'",
										"'.$userIP.'",
										"'.$username.'"
									)';
									
			if (mysql_query($insertLogin_SQL))  {	
				$success = true;
			} else {
				$success = $insertLogin_SQL."<br />".mysql_error();		
			}	
			
		return $success;	
	}
	
	
	function insertLogout() {
		$userID = $_COOKIE["userID"];
		$success = false;
		date_default_timezone_set('GMT');
		$nowTimeStamp = date("Y-m-d H:i:s");
		$Get_acccessID_SQL = "SELECT ID,timeLogin FROM `eAccessLog` WHERE userID=\"$userID\" ORDER BY timeLogin desc ";
		$Get_acccessID_SQL_Query = mysql_query($Get_acccessID_SQL);
		$result = mysql_fetch_assoc($Get_acccessID_SQL_Query);
		$accessLogID = $result['ID'];
		$insertLogout_SQL = "UPDATE eAccessLog SET timeLogout=\"$nowTimeStamp\" where ID=\"$accessLogID\"";
		
									
			if (mysql_query($insertLogout_SQL))  {	
				$success = true;
			} else {
				$success = $insertLogout_SQL."<br />".mysql_error();		
			}	
			
		return $success;	
		
	}
?>