<?php
	


{ 		//	Secure Connection Script
		include('./config/dbConfig.php'); 
		$dbSuccess = false;
		$dbConnected = mysql_connect($db['hostname'],$db['username'],$db['password']);
		
		if ($dbConnected) {		
			$dbSelected = mysql_select_db($db['database'],$dbConnected);
			if ($dbSelected) {
				$dbSuccess = true;
			} 	
		}
		//	END	Secure Connection Script
}

$thisScriptName = "authorize.php";



	$username = $_POST['username'];
	
	if(isset($username)) {
		$password = $_POST['password'];
		
				$md5Password = md5($password);
		

		
		{	
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
					setcookie("loginAuthorised", "loginAuthorised", time()+7200, "/");										    
					setcookie("accessLevel", $accessLevel, time()+7200, "/");	
					setcookie("userID", $userID, time()+7200, "/");				
					header("Location: index2.php");					
			} else {
				echo "Access denied.<br /><br />";		
				echo '<a href="'.$thisScriptName.'">Try again</a>';			
			}
		}
		
	} else { 
		
		include_once('includes/mainContent.php');

	
					

}
	


?>