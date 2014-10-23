<?php

echo '<p style="color: red; font-weight: bolder;">*Please login to continue</p>';

echo '	<form name="postLoginHid" action="index.php" method="post">
			<table>
			<tr>
					<td><P>User: </td>
					<td><INPUT TYPE=text NAME=username value="" SIZE=12 MAXLENGTH=16></P></td>
			</tr>
			<tr>
					<td><P>Password: </td>
					<td><INPUT TYPE=password NAME=password value="" SIZE=12 MAXLENGTH=16></P></td>
			</tr>
			</table>
			</br>
					<input type="submit"  value="Login" />
				
		</form>';
?>