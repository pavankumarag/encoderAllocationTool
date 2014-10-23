<?php

$thisScriptName = "index.php?content=accessLog";
date_default_timezone_set('GMT');
$accessLog_SQL = " select * from eAccessLog ORDER BY userName";
$accessLog_SQL_Query = mysql_query($accessLog_SQL);
$num_of_rows = mysql_num_rows($accessLog_SQL_Query);
echo " There are $num_of_rows results for your request <br /><br />";

echo '<table  border="1" padding="5">';
				echo '<tr class="tableHeader1">
							<td>User Name</td>
							<td>Login Time</td>
							<td>Logout Time</td>
							<td>IP Address</td>';
				while( $row = mysql_fetch_array($accessLog_SQL_Query, MYSQL_ASSOC))
				{
						echo '<tr >
									<td>'.$row['userName'].'</td>
									<td>'.$row['timeLogin'].'</td>
									<td>'.$row['timeLogout'].'</td>
									<td>'.$row['IPaddress'].'</td>
									</tr>';					
				}
				echo '</table>';
				
	echo '<br /><hr align=left style="width:450px"/><br />';
echo '<a href="index.php">Back to Main Page</a>';						
							
						

?>
