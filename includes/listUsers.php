<?php

$thisScriptName = "index.php?content=listUsers";
$user_SQL = "Select eUser.username as user,eUser.email, eAccessControl.userType FROM eUser LEFT JOIN eAccessControl ";
$user_SQL .= "ON eUser.accessLevel = eAccessControl.accessLevel ORDER BY user ";
$user_SQL_Query = mysql_query($user_SQL);
$num_of_rows = mysql_num_rows($user_SQL_Query);
echo " There are $num_of_rows results for your request <br /><br />";

echo '<table  border="1" padding="5">';
				echo '<tr class="tableHeader1">
							<td>User Name</td>
							<td>Email</td>
							<td>Role</td>';
				while( $row = mysql_fetch_array($user_SQL_Query, MYSQL_ASSOC))
				{
						echo '<tr >
									<td>'.$row['user'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['userType'].'</td>
									</tr>';					
				}
				echo '</table>';					
echo '<br /><hr align=left style="width:350px"/>';
echo '<a href="index.php?content=createUser"><span class="header ">Add User</span></a>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php"><span class="header ">Back to Main Page</span></a>';						
							
						

?>