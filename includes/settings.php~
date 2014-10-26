<?php
				
				$userID = $_COOKIE["userID"];
				$Get_username_SQL = "SELECT username from eUser WHERE ID = \"$userID\"";
				$Get_username_SQL_Query = mysql_query($Get_username_SQL);
				$result = mysql_fetch_assoc($Get_username_SQL_Query);
				$userName = $result['username'];
				echo '<p align=left id="settings">Welcome&nbsp;'.$userName;							
				echo ' !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
				Encoder Allocation Tool(EAT)';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;								
							<button type=submit>
 							<a href="index.php?status=logout ">
							<span class="settings">Logout</span>
							</a></button>';
				echo '&nbsp;&nbsp;&nbsp;';
				echo '<button type=submit>
 							<a href="index.php?content=changePassword ">
							<span class="settings">Change Password</span>
							</a></button>';						
				echo '</p>';
				
?>