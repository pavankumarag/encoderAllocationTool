<?php
				
				$userID = $_COOKIE["userID"];
				$Get_username_SQL = "SELECT username from eUser WHERE ID = \"$userID\"";
				$Get_username_SQL_Query = mysql_query($Get_username_SQL);
				$result = mysql_fetch_assoc($Get_username_SQL_Query);
				$userName = $result['username'];
				echo '
            <form id="headerForm" name="logout" action="index.php" method="post">				
				Welcome&nbsp;'.$userName;							
				echo ' !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
				Encoder Allocation Tool(EAT)';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;								
                       
                       <input type="hidden" name="status" value="logout" />
                       <input type="submit" value="Logout"/>
                       </form>';							
							
				echo '&nbsp;&nbsp;&nbsp;';
				echo 	'<form id="headerForm" name="logout" action="index.php" method="post">
                       <input type="hidden" name="content" value="changePassword" />
                       <input type="submit" value="Change Password"/>
                       </form>';			
				echo '&nbsp;&nbsp;'.date_default_timezone_get().'<p></p>';
				
?>