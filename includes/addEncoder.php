<?php


echo '
			<br /><br /><hr align=left style="width:550px"/><br />
			<form name="encoderInsert" action="index.php?content='.$thisPage.'" method="post">
			<table>
			<tr>
			<td>Encoder IP</td>
			<td>Encoder Info</td>
			</tr>
			<tr>
			<td><input type="text" placeholder="Encoder IP" name="encoderIP"  required />
			<td><input type="text" placeholder="Description"  rows="4" cols="50"  SIZE="70" name="encoderInfo"  maxlength="100" required />
			<td><input type="submit" value="add" /> </td>
			</tr>
			</table>
			<input type="hidden" name="addEncoder" value="1" />
			</form>';

?>