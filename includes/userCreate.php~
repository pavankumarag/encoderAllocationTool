<?php

		{  //   collect the data with $_POST
			$username = $_POST["username"];	
			$password = md5($_POST["password"]);
			$passwordValidate = md5($_POST["passwordValidate"]);	
			$eMail = $_POST["eMail"];
			$accessLevel=$_POST["accessLevel"];
		}
			if(isset($username))
			 {
						{	//		check the data before processing it
							$errorMsg = "";		 
							if (strlen($username) < 5) { $errorMsg = "Username cannot be less than 5 characters<br />"; }
							if (strlen($password) < 5) { $errorMsg .= "Password cannot be less than 5 characters<br />"; }
							if ($password <> $passwordValidate) { $errorMsg .= "Password retypedoes not match.<br />"; }
						}
							
						if (empty($errorMsg)) {		
						
							{  //   SQL:     $eUser_SQLinsert				
								$eUser_SQLinsert = "INSERT INTO eUser (";			
								$eUser_SQLinsert .=  "username, ";
								$eUser_SQLinsert .=  "password, ";
								$eUser_SQLinsert .=  "eMail, ";
								$eUser_SQLinsert .=  "accessLevel";
								$eUser_SQLinsert .=  ") ";
								
								$eUser_SQLinsert .=  "VALUES (";
								$eUser_SQLinsert .=  "'".$username."', ";
								$eUser_SQLinsert .=  "'".$password."', ";	
								$eUser_SQLinsert .=  "'".$eMail."', ";
								$eUser_SQLinsert .=  "'".$accessLevel."' ";
								$eUser_SQLinsert .=  ") ";
							}
							
							{	//		run the SQL 
										if (mysql_query($eUser_SQLinsert))  {	
											echo 'New user successfully added.<br /><br />';
											echo '<a href="index.php?content=createUser">
										<span class="mainMenuItem">Add another User</span>
										</a>';
										} else {
											echo '<span style="color:red; ">FAILED to add new user.</span><br /><br />';
											echo mysql_error();	
											echo '<a href="index.php?content=createUser">
										<span class="mainMenuItem">Click to Try Again</span>
										</a>';
											echo '<br /><br />';
										}						
							}
						
						} else {
							{	//		error handling
							echo "There are errors in the data:<br /><br />";
							echo 	$errorMsg."<br /><br />";
							echo '<a href="index.php?content=createUser">
										<span class="mainMenuItem">Click to Try Again</span>
										</a>';
							echo '<br /><br />';		
							}	
						}
			}
			else {
						{	//	create the accessLevel DROPDOWN  FIELD 
				$access_SQL =  "SELECT accessLevel, userType FROM eAccessControl ";
				$access_SQL .= "ORDER By accessLevel ";
				
				$access_SQL_Query = mysql_query($access_SQL);	
	
				$fld_access = '<select name="accessLevel">';		 
				$fld_access .= '<option value="0"> -- access level -- </option>';	
					while ($row = mysql_fetch_array($access_SQL_Query, MYSQL_ASSOC)) {
					    $ID = $row['ID'];
					    $accessLevel = $row['accessLevel'];
					    $userType = $row['userType'];
					    
					    $fld_access .= '<option value="'.$accessLevel.'">'.$userType.'</option>';
					}			
					mysql_free_result($access_SQL_Query);			
				$fld_access .= '</select>';				
			//	END: create the accessLevel DROPDOWN  FIELD 
			}
			{	//	FORM poseUser
			echo '<form name="poseUser" action="index.php?content=createUser" method="post">';
					echo '<input type="hidden" name="saveClicked" value="saveClicked"/>';
					echo '
					<table>
						<tr>
							<td>username</td>
							<td><input type="text" name="username" /></td>
						</tr>
						<tr>
							<td>password</td>
							<td><input type="password" name="password" /></td>
						</tr>
						<tr>
							<td>retype password</td>
							<td><input type="text" name="passwordValidate" /></td>
						</tr>
						<tr>
							<td>eMail</td>
							<td><input type="text" name="eMail" /></td>
						</tr>
						<tr>
							<td>access level</td>
							<td>'.$fld_access.'</td>
						</tr>
						<tr>
							<td></td>
							<td align="right"><input type="submit"  value="Save" /></td>
						</tr>
					</table>
					';
						
			echo '</form>';
			//	END: FORM poseUser 
			}	
			
			
}
?>